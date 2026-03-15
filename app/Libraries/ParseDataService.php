<?php

namespace App\Libraries;

#[\AllowDynamicProperties]
class ParseDataService
{
    public function fetchHtml(string $url): string
    {
        $client = \Config\Services::curlrequest([
            'timeout' => 25,
            'http_errors' => false,
            'verify' => false,
        ]);

        $response = $client->get($url, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (compatible; DPC/1.0; +https://dpboss.net/)',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            ],
        ]);

        return (string) $response->getBody();
    }

    public function parseTktVal(string $html): array
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $loaded = $dom->loadHTML($html);
        libxml_clear_errors();

        if (!$loaded) {
            return [];
        }

        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' tkt-val ')]");
        if (!$nodes || $nodes->length === 0) {
            return [];
        }

        $items = [];
        foreach ($nodes as $node) {
            $text = trim(preg_replace('/\s+/', ' ', $node->textContent ?? ''));
            if ($text !== '') {
                $items[] = $text;
            }
        }

        return $items;
    }

    public function parseResults(string $html): array
    {
        $html = preg_replace('#<\s*br\s*/?>#i', "\n", $html);
        $html = preg_replace('#</\s*(p|div|h[1-6]|li|tr|td)\s*>#i', "\n", $html);
        $text = strip_tags($html);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5);
        $text = preg_replace("/[ \t]+/", " ", $text);
        $text = preg_replace("/\r\n|\r/", "\n", $text);

        $lines = array_values(array_filter(array_map('trim', explode("\n", $text))));

        $startIndex = 0;
        foreach ($lines as $i => $line) {
            if (stripos($line, 'LIVE RESULT') !== false) {
                $startIndex = $i + 1;
                break;
            }
        }

        $results = [];
        for ($i = $startIndex; $i < count($lines); $i++) {
            $line = $lines[$i];
            if (preg_match('/^\d{1,3}-\d{1,2}-\d{1,3}$/', $line)) {
                $name = $lines[$i - 1] ?? '';
                $name = preg_replace('/^#+\s*/', '', $name);
                $name = trim($name);

                $timeLine = $lines[$i + 1] ?? '';
                $startTime = null;
                $endTime = null;

                if (preg_match_all('/\d{1,2}:\d{2}\s*(AM|PM)/i', $timeLine, $m) && count($m[0]) >= 2) {
                    $startTime = $m[0][0];
                    $endTime = $m[0][1];
                }

                $results[] = [
                    'name' => $name,
                    'result' => $line,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'time_text' => $timeLine,
                ];
            }
        }

        return $results;
    }
}
