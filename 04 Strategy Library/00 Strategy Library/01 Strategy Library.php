<?php
/**
 * Created by IntelliJ IDEA.
 * User: Gustavo
 * Date: 5/24/2018
 * Time: 4:42 PM
 */

$strategyMap = [
    [
        'name' => 'CAPM Alpha Ranking Strategy on Dow 30 Companies',
        'link' => 'strategy-library/capm-alpha-ranking-strategy-on-dow-30-companies',
        'description' => 'Applying CAPM model to rank Dow Jones 30 companies'
    ],
    [
        'name' => 'Combining Mean Reversion and Momentum in Forex Market',
        'link' => 'strategy-library/combining-mean-reversion-and-momentum-in-forex-market',
        'description' => 'Combining momentum and mean reversion techniques in the forex markets'
    ],
    [
        'name' => 'Pairs Trading-Copula vs Cointegration',
        'link' => 'strategy-library/pairs-trading-copula-vs-cointegration',
        'description' => 'Applying Copula and Cointergration method to pairs trading'
    ],
    [
        'name' => 'The Dynamic Breakout II Strategy',
        'link' => 'strategy-library/the-dynamic-breakout-ii-strategy',
        'description' => 'A demonstration of dynamic breakout II strategy'
    ],
    [
        'name' => 'Dual Thrust Trading Algorithm',
        'link' => 'strategy-library/dual-thrust-trading-algorithm',
        'description' => 'A demontration of Dual Thrust Intraday strategy'
    ],
    [
        'name' => 'Can Crude Oil Predict Equity Returns',
        'link' => 'strategy-library/can-crude-oil-predict-equity-returns',
        'description' => 'Applying regression method to predict the return from the stock market and compare it to the short-term U.S. T-bill rate'
    ],
    [
        'name' => 'Intraday Dynamic Pairs Trading using Correlation and Cointegration Approach',
        'link' => 'strategy-library/intraday-dynamic-pairs-trading-using-correlation-and-cointegration-approach',
        'description' => 'A high frequency pairs trading algorithm based on cointegration'
    ],
    [
        'name' => 'The Momentum Strategy Based on the Low Frequency Compoment of Forex Market',
        'link' => 'strategy-library/the-momentum-strategy-based-on-the-low-frequency-Component-of-forex-market',
        'description' => 'Applying high frequency filter to the momentum strategy'
    ],
    [
        'name' => 'Stock Selection Strategy Based on Fundamental Factors',
        'link' => 'strategy-library/stock-selection-strategy-based-on-fundamental-factors',
        'description' => 'MorningStar Fundamental factors universe selection algorithm'
    ],
    [
        'name' => 'Short-Term Reversal Strategy in Stocks',
        'link' => 'strategy-library/short-term-reversal-strategy-in-stocks',
        'description' => 'A short term reversal algorithm which gives the opposite signal by analyzing recent period price action'
    ],
    [
        'name' => 'Fundamental Factor Long Short Strategy',
        'link' => 'strategy-library/fundamental-factor-long-short-strategy',
        'description' => 'A basic monthly rebalance long short algorithm based on fundamental factors'
    ],
];

?>
<div class="row">
    <div class="search col-xs-12">
        <input type="text" id="strategy-library-search-box" class="form-control input-lg" placeholder="Search Strategy Tutorials" onchange="SLSearch.OnSearchChange()" onkeyup="SLSearch.OnSearchChange()">
    </div>
</div>
<br>
<table id="strategy-library-table" class="table table-striped qc-table">
    <thead>
    <tr>
        <th>
            Strategy Name
        </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($strategyMap as $strategy) { ?>
        <tr>
            <td>
                <a class="docs-internal-link" href="/tutorials/<?= $strategy['link'] ?>"><?= $strategy['name'] ?></a>
                <p><?= $strategy['description'] ?></p>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<style>
    .documentation .page-sub-heading {
        display: none;
    }

    .documentation #strategy-library-search-box {
        margin: 30px 0;
    }

    .documentation #doc-content .pre-title-area > span {
        display: none;
    }

    .documentation #doc-content .pre-title-area > span:first-child {
        display: inline;
    }

    .documentation #doc-content #strategy-library-table tbody > tr > td > a {
        font-size: 24px;
        margin-top: 16px;
        display: block;
    }
</style>
<script type="application/javascript">
    /**
     * SLSearch static controller
     */
    var SLSearch = /** @class */ (function () {
        function SLSearch() {
        }

        /**
         * Handler for the vent of change in the strategy library search box
         * @constructor
         */
        SLSearch.OnSearchChange = function () {
            if (!SLSearch._BuildSearchMap())
                return;
            var table = $('#strategy-library-table');
            if (table.length == 0)
                return false;
            var search = $('#strategy-library-search-box').val();
            var options = {
                shouldSort: true,
                threshold: 0.8,
                location: 0,
                distance: 100,
                maxPatternLength: 32,
                minMatchCharLength: 3,
                keys: [
                    "text"
                ]
            };
            console.log('starting search');
            var result = SLSearch._StrategyLibraryMap;
            if (search != '') {
                var fuse = new Fuse(SLSearch._StrategyLibraryMap, options);
                result = fuse.search(search);
                if (result.length == 0) {
                    var cols = table.find('thead th').length;
                    result = [{
                        html: "<td colspan='" + cols + "' class='text-center' > No matching result </td>",
                        text: ''
                    }];
                }
            }
            var tableHtml = '';
            for (var i in result) {
                tableHtml += '<tr>' + result[i].html + '</tr>';
            }
            table.find('tbody').html(tableHtml);
            console.log(result);
        };
        /**
         * Builds the strategy library search map
         * @private
         */
        SLSearch._BuildSearchMap = function () {
            if (SLSearch._StrategyLibraryMap !== null)
                return true;
            var table = $('#strategy-library-table');
            if (table.length == 0)
                return false;
            SLSearch._StrategyLibraryMap = [];
            table.find('tbody > tr').each(function (i, el) {
                var text = $(el).text();
                text = text.replace(/(\s+|\n)/g, ' ');
                text = text.replace(/(\s+|\n)/g, ' ');
                SLSearch._StrategyLibraryMap.push({
                    'html': $(el).html(),
                    'text': text
                });
            });
            return true;
        };
        SLSearch._StrategyLibraryMap = null;
        return SLSearch;
    }());
</script>
