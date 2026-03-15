<?php
use CodeIgniter\HTTP\Header;
use CodeIgniter\CodeIgniter;

$errorId = uniqid('error', true);
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title><?= esc($title) ?></title>
    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>

    <script>
        <?= file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.js') ?>
    </script>
</head>
<body onload="init()">

    <!-- Header -->
    <div class="header">
        <div class="environment">
            Displayed at <?= esc(date('H:i:s')) ?> &mdash;
            PHP: <?= esc(PHP_VERSION) ?>  &mdash;
            CodeIgniter: <?= esc(CodeIgniter::CI_VERSION) ?> --
            Environment: <?= ENVIRONMENT ?>
        </div>
        <div class="container">
            <h1><?= esc($title), esc($exception->getCode() ? ' #' . $exception->getCode() : '') ?></h1>
            <p>
                <?= nl2br(esc($exception->getMessage())) ?>
                <a href="https://www.duckduckgo.com/?q=<?= urlencode($title . ' ' . preg_replace('#\'.*\'|\".*\"#Us', '', $exception->getMessage())) ?>"
                   rel="noreferrer" target="_blank">search &rarr;</a>
            </p>
        </div>
    </div>

    <!-- Source -->
    <div class="container">
        <p><b><?= esc(clean_path($file)) ?></b> at line <b><?= esc($line) ?></b></p>

        <?php if (is_file($file)) : ?>
            <div class="source">
                <?= static::highlightFile($file, $line, 15); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="container">
        <?php
        $last = $exception;

        while ($prevException = $last->getPrevious()) {
            $last = $prevException;
            ?>

    <pre>
    Caused by:
    <?= esc($prevException::class), esc($prevException->getCode() ? ' #' . $prevException->getCode() : '') ?>

    <?= nl2br(esc($prevException->getMessage())) ?>
    <a href="https://www.duckduckgo.com/?q=<?= urlencode($prevException::class . ' ' . preg_replace('#\'.*\'|\".*\"#Us', '', $prevException->getMessage())) ?>"
       rel="noreferrer" target="_blank">search &rarr;</a>
    <?= esc(clean_path($prevException->getFile()) . ':' . $prevException->getLine()) ?>
    </pre>

        <?php
        }
        ?>
    </div>

    <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE) : ?>
    <div class="container">

        <ul class="tabs" id="tabs">
            <li><a href="#backtrace">Backtrace</a></li>
            <li><a href="#server">Server</a></li>
            <li><a href="#request">Request</a></li>
            <li><a href="#response">Response</a></li>
            <li><a href="#files">Files</a></li>
            <li><a href="#memory">Memory</a></li>
        </ul>

        <div class="tab-content">

            <!-- Backtrace -->
            <div class="content" id="backtrace">

                <ol class="trace">
                <?php foreach ($trace as $index => $row) : ?>

                    <li>
                        <p>
                            <!-- Trace info -->
                            <?php if (isset($row['file']) && is_file($row['file'])) : ?>
                                <?php
                                if (isset($row['function']) && in_array($row['function'], ['include', 'include_once', 'require', 'require_once'], true)) {
                                    echo esc($row['function'] . ' ' . clean_path($row['file']));
                                } else {
                                    echo esc(clean_path($row['file']) . ' : ' . $row['line']);
                                }
                                ?>
                            <?php else: ?>
                                {PHP internal code}
                            <?php endif; ?>

                            <!-- Class/Method -->
                            <?php if (isset($row['class'])) : ?>
                                &nbsp;&nbsp;&mdash;&nbsp;&nbsp;<?= esc($row['class'] . $row['type'] . $row['function']) ?>
                                <?php if (! empty($row['args'])) : ?>
                                    <?php $argsId = $errorId . 'args' . $index ?>
                                    ( <a href="#" onclick="return toggle('<?= esc($argsId, 'attr') ?>');">arguments</a> )
                                    <div class="args" id="<?= esc($argsId, 'attr') ?>">
                                        <table cellspacing="0">

                                        <?php
                                        $params = null;
                                        // Reflection by name is not available for closure function
                                        if (! str_ends_with($row['function'], '}')) {
                                            $mirror = isset($row['class']) ? new ReflectionMethod($row['class'], $row['function']) : new ReflectionFunction($row['function']);
                                            $params = $mirror->getParameters();
                                        }

                                        foreach ($row['args'] as $key => $value) : ?>
                                            <tr>
                                                <td><code><?= esc(isset($params[$key]) ? '$' . $params[$key]->name : "#{$key}") ?></code></td>
                                                <td><pre><?= esc(print_r($value, true)) ?></pre></td>
                                            </tr>
                                        <?php endforeach ?>

                                        </table>
                                    </div>
                                <?php else : ?>
                                    ()
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (! isset($row['class']) && isset($row['function'])) : ?>
                                &nbsp;&nbsp;&mdash;&nbsp;&nbsp;    <?= esc($row['function']) ?>()
                            <?php endif; ?>
                        </p>

                        <!-- Source? -->
                        <?php if (isset($row['file']) && is_file($row['file']) && isset($row['class'])) : ?>
                            <div class="source">
                                <?= static::highlightFile($row['file'], $row['line']) ?>
                            </div>
                        <?php endif; ?>
                    </li>

                <?php endforeach; ?>
                </ol>

            </div>

            <!-- Server -->
            <div class="content" id="server">
                <?php foreach (['_SERVER', '_SESSION'] as $var) : ?>
                    <?php
                    if (empty($GLOBALS[$var]) || ! is_array($GLOBALS[$var])) {
                        continue;
                    } ?>

                    <h3>$<?= esc($var) ?></h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($GLOBALS[$var] as $key => $value) : ?>
                            <tr>
                                <td><?= esc($key) ?></td>
                                <td>
                                    <?php if (is_string($value)) : ?>
                                        <?= esc($value) ?>
                                    <?php else: ?>
                                        <pre><?= esc(print_r($value, true)) ?></pre>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endforeach ?>

                <!-- Constants -->
                <?php $constants = get_defined_constants(true); ?>
                <?php if (! empty($constants['user'])) : ?>
                    <h3>Constants</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($constants['user'] as $key => $value) : ?>
                            <tr>
                                <td><?= esc($key) ?></td>
                                <td>
                                    <?php if (! is_array($value) && ! is_object($value)) : ?>
                                        <?= esc($value) ?>
                                    <?php else: ?>
                                        <pre><?= esc(print_r($value, true)) ?></pre>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <!-- Request -->
            <div class="content" id="request">
                <?php $request = \Config\Services::request(); ?>

                <table>
                    <tbody>
                        <tr>
                            <td style="width: 10em">Path</td>
                            <td><?= esc($request->getPath()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">HTTP Method</td>
                            <td><?= esc($request->getMethod()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Scheme</td>
                            <td><?= esc($request->getUri()->getScheme()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Port</td>
                            <td><?= esc($request->getUri()->getPort()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Host</td>
                            <td><?= esc($request->getUri()->getHost()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Locale</td>
                            <td><?= esc($request->getLocale()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Controller</td>
                            <td><?= esc($controller) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Method</td>
                            <td><?= esc($method) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Response -->
            <div class="content" id="response">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 10em">Response Code</td>
                            <td><?= esc($response->getStatusCode()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Response Message</td>
                            <td><?= esc($response->getReason()) ?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <?php if (is_file(APPPATH . 'Views/' . ENVIRONMENT . '/response_info.php')) : ?>
                    <?php include APPPATH . 'Views/' . ENVIRONMENT . '/response_info.php'; ?>
                <?php elseif (is_file(APPPATH . 'Views/errors/html/response_info.php')) : ?>
                    <?php include APPPATH . 'Views/errors/html/response_info.php'; ?>
                <?php endif; ?>
            </div>

            <!-- Files -->
            <div class="content" id="files">
                <table>
                    <tbody>
                        <tr>
                            <th>File</th>
                            <th>Size</th>
                            <th>Last Modified</th>
                        </tr>
                    </tbody>
                    <?php foreach (get_included_files() as $file) : ?>
                        <?php if (strpos($file, FCPATH) === 0 || strpos($file, APPPATH) === 0) : ?>
                        <tr>
                            <td><?= esc(clean_path($file)) ?></td>
                            <td><?= esc(number_to_size(filesize($file))) ?></td>
                            <td><?= esc(date('Y-m-d H:i:s', filemtime($file))) ?></td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </table>
            </div>

            <!-- Memory -->
            <div class="content" id="memory">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 10em">Memory Usage</td>
                            <td><?= esc(number_to_size(memory_get_usage(true))) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Peak Memory Usage</td>
                            <td><?= esc(number_to_size(memory_get_peak_usage(true))) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php endif; ?>

</body>
</html>
