// Create the first Line chart. Note the animationTraceCenter
// property is set to true which changes the behaviour of the
// trace() effect. The backgroundGrid and axes are enabled on this
// chart (horizontal lines only). The charts are all filled and
// splines. The effect used is (obviously) the trace effect and
// the callback function creates the second Line chart.
l1 = new RGraph.Line({
    id: 'cvs',
    data: [8, 6, 3, 5, 12, 8, 5, 4, 6, 12],
    options: {
        animationTraceCenter: true,
        tickmarksStyle: null,
        shadow: false,
        linewidth: 0,
        backgroundGridVlines: false,
        backgroundGridBorder: false,
        xaxis: false,
        yaxis: false,
        spline: true,
        filled: true,
        colors: ['Gradient(#fcc:red)'],
        yaxisScaleMax: 35,
        xaxisLabels: ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00']
    }
}).trace(null, function() {
    // Create the second Line chart. Again this uses the
    // animationTraceCenter property that modifies the
    // trace() effect. It has no axes or backgroundGrid
    // - these are defined on the first chart. Note that
    // unlike the first chart this has two datasets
    // defined - the dataset from the first chart (which
    // is transparent) and this charts dataaset.
    new RGraph.Line({
        id: 'cvs',
        data: [
            [8, 6, 3, 5, 12, 8, 5, 4, 6, 12],
            [4, 8, 6, 3, 5, 2, 4, 8, 5, 2]
        ],
        options: {
            animationTraceCenter: true,
            tickmarksStyle: null,
            shadow: false,
            linewidth: 0,
            backgroundGrid: false,
            xaxis: false,
            yaxis: false,
            colors: ['transparent', 'Gradient(white:green)'],
            spline: true,
            filled: true,
            yaxisScaleMax: 35
        }
    }).trace(null, function() {
        // Again the trace() effect callback function is used
        // to trigger the drawing of the next Line chart.
        // Three datasets now - ie all three. The first two are
        // colored transparent so that you can't see them. Like
        // the second chart there's no backgroundGrid or axes and
        // with this being the final chart - there's no callback
        // function.
        new RGraph.Line({
            id: 'cvs',
            data: [
                [8, 6, 3, 5, 12, 8, 5, 4, 6, 12],
                [4, 8, 6, 3, 5, 2, 4, 8, 5, 2],
                [8, 6, 3, 5, 9, 4, 5, 8, 4, 6]
            ],
            options: {
                animationTraceCenter: true,
                tickmarksStyle: null,
                shadow: false,
                linewidth: 0,
                backgroundGrid: false,
                xaxis: false,
                yaxis: false,
                colors: ['transparent', 'transparent', 'Gradient(white:blue)'],
                spline: true,
                filled: true,
                yaxisScaleMax: 35
            }
        }).trace();
    });
});

// Add some responsiveness to the charts. This is added to the first chart but since all three
// are being drawn on the same canvas it doesn't need to be added to each chart object.
l1.responsive([{
    maxWidth: null,
    width: 500,
    height: 250,
    options: { textSize: 10 },
    css: {

    }
}, { maxWidth: 900, width: 400, height: 200, options: { textSize: 8 }, css: { 'float': 'none' } }]);