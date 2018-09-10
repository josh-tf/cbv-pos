(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define([], function () {
      return (root.returnExportsGlobal = factory());
    });
  } else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like enviroments that support module.exports,
    // like Node.
    module.exports = factory();
  } else {
    root['Chartist.plugins.ctBarLabels'] = factory();
  }
}(this, function () {

  (function(root, factory) {
    if (typeof define === 'function' && define.amd) {
      // AMD. Register as an anonymous module.
      define([], function() {
        return (root.returnExportsGlobal = factory());
      });
    } else if (typeof exports === 'object') {
      // Node. Does not work with strict CommonJS, but
      // only CommonJS-like enviroments that support module.exports,
      // like Node.
      module.exports = factory();
    } else {
      root['Chartist.plugins.ctBarLabels'] = factory();
    }
  }(this, function() {

    /**
     * Chartist.js plugin to display a data label on a bar in a bar chart.
     */
    /* global Chartist */
    (function(window, document, Chartist) {
      'use strict';

      var defaultOptionsBase = {
        labelClass: 'ct-label',
        labelInterpolationFnc: Chartist.noop,
        labelPositionFnc: undefined,
        showZeroLabels: false,
        includeIndexClass: false,
        thresholdPercentage: 30,
        thresholdOptions: {
          belowLabelClass: 'ct-label-below',
          aboveLabelClass: 'ct-label-above'
        }
      };

      var defaultOptionsHorizontalBars = {
        labelOffset: {
          x: 2,
          y: 4
        },
        textAnchor: 'start'
      }

      var defaultOptionsVerticalBars = {
        labelOffset: {
          x: 0,
          y: -2
        },
        textAnchor: 'middle'
      }

      Chartist.plugins = Chartist.plugins || {};
      Chartist.plugins.ctBarLabels = function(options) {

        return function ctBarLabels(chart) {
          if (chart instanceof Chartist.Bar) {

            options = Chartist.extend({}, defaultOptionsBase, options);
            if (chart.options.horizontalBars) {
              options = Chartist.extend({}, defaultOptionsHorizontalBars, options);
            } else {
              options = Chartist.extend({}, defaultOptionsVerticalBars, options);
            }

            var highValue = getHighValue(chart);

            chart.on('draw', function(data) {
              if (data.type === 'bar') {

                // bar value is in a different spot depending on whether or not the chart is horizontalBars
                var barValue = data.value.x === undefined ? data.value.y : data.value.x;
                var indexClass = options.includeIndexClass ? ['ct-bar-label-i-', data.seriesIndex, '-', data.index].join('') : '';
                var thresholdClass = getThresholdClass(options.thresholdPercentage, options.thresholdOptions, highValue, barValue);
                var positionData = handleLabelPosition(options.labelPositionFnc, highValue, barValue, options.thresholdPercentage);
                options = Chartist.extend({}, options, positionData);

                if (options.showZeroLabels || (!options.showZeroLabels && barValue != 0)) {
                  data.group.elem('text', {
                    x: ((options.startAtBase &&  chart.options.horizontalBars) ? data.x1 : data.x2) + options.labelOffset.x,
                    y: ((options.startAtBase && !chart.options.horizontalBars) ? data.y1 : data.y2) + options.labelOffset.y,
                    style: 'text-anchor: ' + options.textAnchor
                  }, [options.labelClass, indexClass, thresholdClass].join(' ')).text(options.labelInterpolationFnc(barValue));
                }
              }
            });
          }
        };
      };

      Chartist.plugins.ctBarLabels.InsetLabelsPositionHorizontal = function(data) {

        if (data.high && data.value && data.threshold) {
          var aboveThreshold = (data.value / data.high * 100 > data.threshold);

          if (aboveThreshold) {
            return {
              labelOffset: {
                x: -2,
                y: 4
              },
              textAnchor: 'end'
            }
          } else {
            return {
              labelOffset: {
                x: 2,
                y: 4
              },
              textAnchor: 'start'
            };
          }
        }
      };

    }(window, document, Chartist));

    return Chartist.plugins.ctBarLabels;

    function getHighValue(chart) {

      // respect the user provided options for the max value first
      if (chart.options.horizontalBars && chart.options.axisX && chart.options.axisX.high) {
        // the horizontal chart has a high on the X axis
        return chart.options.axisX.high;
      } else if (!chart.options.horizontalBars && chart.options.axisY && chart.options.axisY.high) {
        // the vertical chart has a high on the Y axis
        return chart.options.axisY.high;
      } else if (chart.options.high) {
        // the chart has a high set on its own options
        return chart.options.high;
      } else {
        // the user did not set any high value, so we will need to calculate the max value
        if (chart.data && chart.data.series && chart.data.series.length > 0) {
          var series = chart.data.series;
          // check to see if there are multiple series
          if (series[0].constructor === Array) {
            series = series.reduce(function(prev, curr) {
              return prev.concat(curr)
            });
          }

          // return the highest value
          return Math.max.apply(null, series);
        }
      }
    }

    function getThresholdClass(percentage, options, high, val) {
      if (percentage && options && high) {
        return (val / high * 100 > percentage) ? options.aboveLabelClass : options.belowLabelClass;
      } else {
        return '';
      }
    }

    function handleLabelPosition(lblPositionFnc, highValue, barValue, thresholdPercentage) {
      if (!lblPositionFnc)
        return {};

      var positionData = lblPositionFnc({
        high: highValue,
        value: barValue,
        threshold: thresholdPercentage
      });

      var result = {};
      // sanitize the object just in case they tried to override other options that will get merged
      // TODO: make this terse
      if (positionData.labelOffset) {
        result.labelOffset = positionData.labelOffset;

        if (positionData.labelOffset.x)
          result.labelOffset.x = positionData.labelOffset.x;

        if (positionData.labelOffset.y)
          result.labelOffset.y = positionData.labelOffset.y;
      }
      if (positionData.textAnchor)
        result.textAnchor = positionData.textAnchor;

      return result;
    }

  }));

  return Chartist.plugins.ctBarLabels;

}));
