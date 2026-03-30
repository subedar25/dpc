<div class="liv-rslt">
    <h4>☔LIVE RESULT☔</h4>
    <div class="lv-mc" >
        Sabse Tezz Live Result Yahi Milega
    <div id="live-result-list">
        <!-- <span class="h8">PUNA BAZAR</span>
        <span class="h9"> 258-5</span>

        <button onclick="window.location.reload()">Refresh</button>

        <span class="h8">PAISA BAZAR DAY</span>
        <span class="h9">Loading....</span>

        <button onclick="window.location.reload()">Refresh</button>
        <br> -->
    </div>
    </div>
</div>

<script type="text/javascript">
        function refresh_page() { //alert('hi');
            $("#loaderdiv").show();
            document.location.reload();
            //  window.scrollTo(0, 0);

        }

        function timeToMinutes(t) {
            if (!t) return null;
            var parts = t.split(':');
            if (parts.length < 2) return null;
            var h = parseInt(parts[0], 10);
            var m = parseInt(parts[1], 10);
            if (isNaN(h) || isNaN(m)) return null;
            return (h * 60) + m;
        }

        function withinWindow(nowMin, targetMin, before, after) {
            if (targetMin === null) return false;
            return nowMin >= (targetMin - before) && nowMin <= (targetMin + after);
        }

        function buildResultText(row) {
            var open = row.com_open || '';
            var mid = row.com_mid || '';
            var close = row.com_close || '';
            if (!open && !mid && !close) return '';
            return [open, mid, close].filter(function (p) { return p !== ''; }).join('-');
        }

        function renderLiveResults(items) {
            var now = new Date();
            var nowMin = now.getHours() * 60 + now.getMinutes();
            var html = '';

            items.forEach(function (row) {
                var startMin = timeToMinutes(row.com_starttime || row.start_time);
                var endMin = timeToMinutes(row.com_endtime || row.end_time);
                var showOpen = withinWindow(nowMin, startMin, 5, 15);
                var showClose = withinWindow(nowMin, endMin, 5, 15);
                if (!showOpen && !showClose) return;

                var loading = (showOpen && !row.com_open) || (showClose && !row.com_close);
                var resultText = loading ? 'Loading...' : buildResultText(row);

                html += '<div style=" border-bottom: 1px solid red;padding-bottom: 11px;">' +
                    '<div><font size="5" color="#0033cc">' + (row.name || '') + '</font></div>' +
                    '<font size="5" color="#000">' + (resultText || '') + '</font><br>' +
                    '</div>';
            });

            if (!html) {
                html = '<div> No Result Now. </div>';
            }

            document.getElementById('live-result-list').innerHTML = html;
        }

        function fetchLiveResults() {
            fetch("<?php echo site_url('liveresultjson'); ?>")
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    if (data && data.data) {
                        renderLiveResults(data.data);
                    }
                })
                .catch(function () {});
        }

        fetchLiveResults();
        setInterval(fetchLiveResults, 10000);
    </script>