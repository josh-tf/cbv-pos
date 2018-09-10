# chartist-plugin-barlabels

[![Build Status](https://travis-ci.org/mtgibbs/chartist-plugin-barlabels.svg?branch=master)](https://travis-ci.org/mtgibbs/chartist-plugin-barlabels)
[![NPM Version](https://img.shields.io/npm/v/chartist-plugin-barlabels.svg)](https://www.npmjs.com/package/chartist-plugin-barlabels)

[Chartist-js](https://github.com/gionkunz/chartist-js) Plugin for labelling the end of bars in Bar Charts.


##Usage

##### Default Options

There are two sets of default options depending on if the chart.options has horizontalBars set to true or false.

```javascript
// if chart.options.horizontalBars == true

var defaultOptions = {
  labelClass: 'ct-label',
  labelInterpolationFnc: Chartist.noop,
  labelOffset: {
    x: 2,
    y: 4
  },
  labelPositionFnc: undefined,
  startAtBase: undefined,
  textAnchor: 'start',
  showZeroLabels: false,
  includeIndexClass: false,
  thresholdPercentage: 30,
  thresholdOptions: {
    belowLabelClass: 'ct-label-below',
    aboveLabelClass: 'ct-label-above'
  }
}
```

```javascript
// if chart.options.horizontalBars == false / undefined

var defaultOptions = {
  labelClass: 'ct-label',
  labelInterpolationFnc: Chartist.noop,
  labelOffset: {
    x: 0,
    y: -2
  },
  labelPositionFnc: undefined,
  startAtBase: undefined,
  textAnchor: 'middle',
  showZeroLabels: false,
  includeIndexClass: false,
  thresholdPercentage: 30,
  thresholdOptions: {
    belowLabelClass: 'ct-label-below',
    aboveLabelClass: 'ct-label-above'
  }
}
```

##### Label Position Function

The label position function can be used to conditionally influence the location of the label relative to the bar.  The function has some bar data being passed to it in this format:

```javascript
{
  high: number; // the highest value in the chart or the defined high in the options
  value: number; // the value of the bar that the label will belong to
  threshold: number; // the percentage threshold defined in the options
}
```

The function must return labelOffset and textAnchor data otherwise when this data is undefined it will fall back on the default offsets.

```javascript
{
  labelOffset: {
    x: number // the offset to the label on the X axis
    y: number // the offset to the label on the Y axis
  },
  textAnchor: string // the css text-anchor value
}

```

The plugin comes with a default example.

```javascript
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
```

##### Example Script

```javascript
new Chartist.Bar('#test-bar-chart', {
    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
    series: [
      [5, 4, 3, 7, 5, 10, 3],
      [1, 2, 3, 4, 5, 6, 7]
    ]
  }, {
    seriesBarDistance: 10,
    reverseData: true,
    horizontalBars: true,
    axisY: {
      offset: 70
    },
    plugins: [
      Chartist.plugins.ctBarLabels()
    ]
  });
```

##### Example Screenshot
![Example Graph](http://i.imgur.com/RJcOkJM.png)
