RGraph = window.RGraph || { isrgraph: true, isRGraph: true, rgraph: true };
RGraph.Line = function(conf) {
    var id = conf.id,
        canvas = document.getElementById(id),
        data = conf.data;
    this.id = id;
    this.canvas = canvas;
    this.context = this.canvas.getContext('2d');
    this.canvas.__object__ = this;
    this.type = 'line';
    this.max = 0;
    this.coords = [];
    this.coords2 = [];
    this.coords.key = [];
    this.coordsText = [];
    this.coordsSpline = [];
    this.coordsAxes = { xaxis: [], yaxis: [] };
    this.hasnegativevalues = false;
    this.isRGraph = true;
    this.isrgraph = true;
    this.rgraph = true;
    this.uid = RGraph.createUID();
    this.canvas.uid = this.canvas.uid ? this.canvas.uid : RGraph.createUID();
    this.colorsParsed = false;
    this.original_colors = [];
    this.firstDraw = true;
    this.properties = { backgroundBarsCount: null, backgroundBarsColor1: 'rgba(0,0,0,0)', backgroundBarsColor2: 'rgba(0,0,0,0)', backgroundGrid: 1, backgroundGridLinewidth: 1, backgroundGridHsize: 25, backgroundGridVsize: 25, backgroundGridColor: '#ddd', backgroundGridVlines: true, backgroundGridHlines: true, backgroundGridBorder: true, backgroundGridAutofit: true, backgroundGridAutofitAlign: true, backgroundGridHlinesCount: 5, backgroundGridVlinesCount: null, backgroundGridDashed: false, backgroundGridDotted: false, backgroundHbars: null, backgroundImage: null, backgroundImageStretch: true, backgroundImageX: null, backgroundImageY: null, backgroundImageW: null, backgroundImageH: null, backgroundImageAlign: null, backgroundColor: null, xaxis: true, xaxisLinewidth: 1, xaxisColor: 'black', xaxisTickmarks: true, xaxisTickmarksLength: 3, xaxisTickmarksLastLeft: null, xaxisTickmarksLastRight: null, xaxisTickmarksCount: null, xaxisLabels: null, xaxisLabelsFormattedDecimals: 0, xaxisLabelsFormattedPoint: '.', xaxisLabelsFormattedThousand: ',', xaxisLabelsFormattedUnitsPre: '', xaxisLabelsFormattedUnitsPost: '', xaxisLabelsSize: null, xaxisLabelsFont: null, xaxisLabelsItalic: null, xaxisLabelsBold: null, xaxisLabelsColor: null, xaxisLabelsOffsetx: 0, xaxisLabelsOffsety: 0, xaxisLabelsHalign: null, xaxisLabelsValign: null, xaxisLabelsPosition: 'edge', xaxisLabelsSpecificAlign: 'left', xaxisPosition: 'bottom', xaxisPosition: 'bottom', xaxisLabelsAngle: 0, xaxisTitle: '', xaxisTitleBold: null, xaxisTitleSize: null, xaxisTitleFont: null, xaxisTitleColor: null, xaxisTitleItalic: null, xaxisTitlePos: null, xaxisTitleOffsetx: 0, xaxisTitleOffsety: 0, xaxisTitleX: null, xaxisTitleY: null, xaxisTitleHalign: 'center', xaxisTitleValign: 'top', yaxis: true, yaxisLinewidth: 1, yaxisColor: 'black', yaxisTickmarks: true, yaxisTickmarksCount: null, yaxisTickmarksLastTop: null, yaxisTickmarksLastBottom: null, yaxisTickmarksLength: 3, yaxisScale: true, yaxisScaleMin: 0, yaxisScaleMax: null, yaxisScaleUnitsPre: '', yaxisScaleUnitsPost: '', yaxisScaleDecimals: 0, yaxisScalePoint: '.', yaxisScaleThousand: ',', yaxisScaleRound: false, yaxisScaleFormatter: null, yaxisScaleInvert: false, yaxisLabelsSpecific: null, yaxisLabelsCount: 5, yaxisLabelsOffsetx: 0, yaxisLabelsOffsety: 0, yaxisLabelsHalign: null, yaxisLabelsValign: null, yaxisLabelsFont: null, yaxisLabelsSize: null, yaxisLabelsColor: null, yaxisLabelsBold: null, yaxisLabelsItalic: null, yaxisLabelsPosition: 'edge', yaxisPosition: 'left', yaxisTitle: '', yaxisTitleBold: null, yaxisTitleSize: null, yaxisTitleFont: null, yaxisTitleColor: null, yaxisTitleItalic: null, yaxisTitlePos: null, yaxisTitleX: null, yaxisTitleY: null, yaxisTitleOffsetx: 0, yaxisTitleOffsety: 0, yaxisTitleHalign: null, yaxisTitleValign: null, yaxisTitleAccessible: null, labelsAbove: false, labelsAboveDecimals: null, labelsAboveSize: null, labelsAboveColor: null, labelsAboveFont: null, labelsAboveBold: null, labelsAboveItalic: null, labelsAboveBackground: 'rgba(255,255,255,0.7)', labelsAboveBorder: false, labelsAboveUnitsPre: '', labelsAboveUnitsPost: '', labelsAboveSpecific: null, labelsAboveOffsetx: 0, labelsAboveOffsety: 0, linewidth: 2.001, linecap: 'round', linejoin: 'round', colors: ['red', '#0f0', '#00f', '#f0f', '#ff0', '#0ff', 'green', 'pink', 'blue', 'black'], tickmarksStyle: 'none', tickmarksLinewidth: null, tickmarksSize: 3, tickmarksColor: null, tickmarksStyleDotStroke: 'white', tickmarksStyleDotFill: null, tickmarksStyleDotLinewidth: 3, tickmarksStyleImage: null, tickmarksStyleImageHalign: 'center', tickmarksStyleImageValign: 'center', tickmarksStyleImageOffsetx: 0, tickmarksStyleImageOffsety: 0, marginLeft: 35, marginRight: 35, marginTop: 35, marginBottom: 35, marginInner: 0, filledColors: null, textBold: false, textItalic: false, textSize: 12, textColor: 'black', textFont: 'Arial, Verdana, sans-serif', textAccessible: true, textAccessibleOverflow: 'visible', textAccessiblePointerevents: false, title: '', titleBackground: null, titleHpos: null, titleVpos: null, titleFont: null, titleSize: null, titleColor: null, titleBold: null, titleItalic: null, titleX: null, titleY: null, titleHalign: null, titleValign: null, titleOffsetx: 0, titleOffsety: 0, shadow: true, shadowOffsetx: 2, shadowOffsety: 2, shadowBlur: 3, shadowColor: 'rgba(128,128,128,0.5)', tooltips: null, tooltipsHotspotXonly: false, tooltipsHotspotSize: 5, tooltipsEffect: 'slide', tooltipsCssClass: 'RGraph_tooltip', tooltipsCss: null, tooltipsEvent: 'onmousemove', tooltipsHighlight: true, tooltipsCoordsPage: false, tooltipsFormattedThousand: ',', tooltipsFormattedPoint: '.', tooltipsFormattedDecimals: 0, tooltipsFormattedUnitsPre: '', tooltipsFormattedUnitsPost: '', tooltipsFormattedKeyColors: null, tooltipsFormattedKeyColorsShape: 'square', tooltipsFormattedKeyLabels: [], tooltipsFormattedListType: 'ul', tooltipsFormattedListItems: null, tooltipsFormattedTableHeaders: null, tooltipsFormattedTableData: null, tooltipsDataset: null, tooltipsDatasetEvent: 'click', tooltipsPointer: true, tooltipsPositionStatic: true, highlightStyle: null, highlightStroke: 'gray', highlightFill: 'white', highlightPointRadius: 2, stepped: false, key: null, keyBackground: 'white', keyPosition: 'graph', keyHalign: null, keyShadow: false, keyShadowColor: '#666', keyShadowBlur: 3, keyShadowOffsetx: 2, keyShadowOffsety: 2, keyPositionMarginBoxed: false, keyPositionX: null, keyPositionY: null, keyColorShape: 'square', keyRounded: true, keyLinewidth: 1, keyColors: null, keyInteractive: false, keyInteractiveHighlightChartStroke: 'rgba(255,0,0,0.3)', keyInteractiveHighlightLabel: 'rgba(255,0,0,0.2)', keyLabelsFont: null, keyLabelsSize: null, keyLabelsColor: null, keyLabelsBold: null, keyLabelsItalic: null, keyLabelsOffsetx: 0, keyLabelsOffsety: 0, contextmenu: null, crosshairs: false, crosshairsColor: '#333', crosshairsHline: true, crosshairsVline: true, annotatable: false, annotatableColor: 'black', annotatableLinewidth: 1, filled: false, filledRange: false, filledRangeThreshold: null, filledRangeThresholdColors: ['red', 'green'], filledAccumulative: true, variant: null, axesAbove: false, backdrop: false, backdropSize: 30, backdropAlpha: 0.2, adjustable: false, adjustableOnly: null, adjustableXonly: false, redraw: true, outofbounds: false, outofboundsClip: false, animationFactor: 1, animationUnfoldX: false, animationUnfoldY: true, animationUnfoldInitial: 2, animationTraceClip: 1, animationTraceCenter: false, spline: false, lineVisible: [], errorbars: false, errorbarsColor: 'black', errorbarsCapped: true, errorbarsCappedWidth: 12, errorbarsLinewidth: 1, combinedEffect: null, combinedEffectOptions: null, combinedEffectCallback: null, clearto: 'rgba(0,0,0,0)', dotted: false, dashed: false, trendline: false, trendlineColors: ['#666'], trendlineLinewidth: 1, trendlineMargin: 25, trendlineDashed: false, trendlineDotted: false, trendlineDashArray: null, trendlineClip: true, nullBridge: false, nullBridgeLinewidth: null, nullBridgeColors: null, nullBridgeDashArray: [5, 5], labelsAngled: false, labelsAngledSpecific: null, labelsAngledAccessible: null, labelsAngledFont: null, labelsAngledColor: null, labelsAngledSize: null, labelsAngledBold: null, labelsAngledItalic: null, labelsAngledUpFont: null, labelsAngledUpColor: null, labelsAngledUpSize: null, labelsAngledUpBold: null, labelsAngledUpItalic: null, labelsAngledDownFont: null, labelsAngledDownColor: null, labelsAngledDownSize: null, labelsAngledDownBold: null, labelsAngledDownItalic: null, labelsAngledLevelFont: null, labelsAngledLevelColor: null, labelsAngledLevelSize: null, labelsAngledLevelBold: null, labelsAngledILeveltalic: null }
    this.original_data = RGraph.stringsToNumbers(conf.data);
    if (typeof this.original_data[0] === 'number' || RGraph.isNull(this.original_data[0])) { this.original_data = [RGraph.arrayClone(this.original_data)]; }
    if (!this.canvas) { alert('[LINE] Fatal error: no canvas support'); return; }
    this.data_arr = RGraph.arrayLinearize(this.original_data);
    for (var i = 0; i < this.data_arr.length; ++i) { this['$' + i] = {}; }
    var properties = this.properties;
    this.path = RGraph.pathObjectFunction;
    if (RGraph.Effects && typeof RGraph.Effects.decorate === 'function') { RGraph.Effects.decorate(this); }
    this.responsive = RGraph.responsive;
    this.set = function(name) {
        var value = typeof arguments[1] === 'undefined' ? null : arguments[1];
        if (arguments.length === 1 && typeof arguments[0] === 'object') {
            for (i in arguments[0]) { if (typeof i === 'string') { this.set(i, arguments[0][i]); } }
            return this;
        }
        properties[name] = value;
        return this;
    };
    this.get = function(name) { return properties[name]; };
    this.draw = function() {
        if (typeof properties.backgroundImage == 'string') { RGraph.drawBackgroundImage(this); }
        RGraph.fireCustomEvent(this, 'onbeforedraw');
        if (!this.canvas.__rgraph_aa_translated__) {
            this.context.translate(0.5, 0.5);
            this.canvas.__rgraph_aa_translated__ = true;
        }
        if (!this.colorsParsed) {
            this.parseColors();
            this.colorsParsed = true;
        }
        this.marginLeft = properties.marginLeft;
        this.marginRight = properties.marginRight;
        this.marginTop = properties.marginTop;
        this.marginBottom = properties.marginBottom;
        if (properties.xaxisLabels && properties.xaxisLabels.length) {
            if (typeof properties.xaxisLabels === 'string') { properties.xaxisLabels = RGraph.arrayPad({ array: [], length: this.original_data[0].length, value: properties.xaxisLabels }); }
            for (var i = 0; i < properties.xaxisLabels.length; ++i) { properties.xaxisLabels[i] = RGraph.labelSubstitution({ object: this, text: properties.xaxisLabels[i], index: i, value: this.original_data[0][i], decimals: properties.xaxisLabelsFormattedDecimals || 0, unitsPre: properties.xaxisLabelsFormattedUnitsPre || '', unitsPost: properties.xaxisLabelsFormattedUnitsPost || '', thousand: properties.xaxisLabelsFormattedThousand || ',', point: properties.xaxisLabelsFormattedPoint || '.' }); }
        }
        this.data = RGraph.arrayClone(this.original_data);
        this.max = 0;
        if (properties.filled && !properties.filledRange && this.data.length > 1 && properties.filledAccumulative) {
            var accumulation = [];
            for (var set = 0; set < this.data.length; ++set) {
                for (var point = 0; point < this.data[set].length; ++point) {
                    this.data[set][point] = Number(accumulation[point] ? accumulation[point] : 0) + this.data[set][point];
                    accumulation[point] = this.data[set][point];
                }
            }
        }
        if (properties.yaxisScaleMax) {
            this.max = properties.yaxisScaleMax;
            this.min = properties.yaxisScaleMin ? properties.yaxisScaleMin : 0;
            this.scale2 = RGraph.getScale({ object: this, options: { 'scale.max': this.max, 'scale.min': properties.yaxisScaleMin, 'scale.strict': true, 'scale.thousand': properties.yaxisScaleThousand, 'scale.point': properties.yaxisScalePoint, 'scale.decimals': properties.yaxisScaleDecimals, 'scale.labels.count': properties.yaxisLabelsCount, 'scale.round': properties.yaxisScaleRound, 'scale.units.pre': properties.yaxisScaleUnitsPre, 'scale.units.post': properties.yaxisScaleUnitsPost } });
            this.max = this.scale2.max ? this.scale2.max : 0;
            if (!properties.outofbounds) { for (dataset = 0; dataset < this.data.length; ++dataset) { if (RGraph.isArray(this.data[dataset])) { for (var datapoint = 0; datapoint < this.data[dataset].length; datapoint++) { this.hasnegativevalues = (this.data[dataset][datapoint] < 0) || this.hasnegativevalues; } } } }
        } else {
            this.min = properties.yaxisScaleMin ? properties.yaxisScaleMin : 0;
            for (dataset = 0; dataset < this.data.length; ++dataset) { for (var datapoint = 0; datapoint < this.data[dataset].length; datapoint++) { this.max = Math.max(this.max, this.data[dataset][datapoint] ? Math.abs(parseFloat(this.data[dataset][datapoint])) : 0); if (!properties.outofbounds) { this.hasnegativevalues = (this.data[dataset][datapoint] < 0) || this.hasnegativevalues; } } }
            this.scale2 = RGraph.getScale({ object: this, options: { 'scale.max': this.max, 'scale.min': properties.yaxisScaleMin, 'scale.thousand': properties.yaxisScaleThousand, 'scale.point': properties.yaxisScalePoint, 'scale.decimals': properties.yaxisScaleDecimals, 'scale.labels.count': properties.yaxisLabelsCount, 'scale.round': properties.yaxisScaleRound, 'scale.units.pre': properties.yaxisScaleUnitsPre, 'scale.units.post': properties.yaxisScaleUnitsPost, 'scale.formatter': properties.yaxisScaleFormatter } });
            this.max = this.scale2.max ? this.scale2.max : 0;
        }
        if (properties.contextmenu) { RGraph.showContext(this); }
        this.coords = [];
        this.coordsText = [];
        this.grapharea = this.canvas.height - this.marginTop - this.marginBottom;
        this.halfgrapharea = this.grapharea / 2;
        this.halfTextHeight = properties.textSize / 2;
        if (properties.variant == '3d') { RGraph.draw3DAxes(this); }
        RGraph.Background.draw(this);
        if (properties.backgroundHbars && properties.backgroundHbars.length > 0) { RGraph.drawBars(this); }
        if (!properties.axesAbove) { this.drawAxes(); }
        this.context.save()
        this.context.beginPath();
        if (properties.animationTraceCenter) { this.context.rect((this.canvas.width / 2) * (1 - properties.animationTraceClip), 0, this.canvas.width * properties.animationTraceClip, this.canvas.height); } else { this.context.rect(0, 0, this.canvas.width * properties.animationTraceClip, this.canvas.height); }
        this.context.clip();
        for (var i = 0, j = 0, len = this.data.length; i < len; i++, j++) {
            this.context.beginPath();
            if (!properties.filled) { this.setShadow(i); }
            if (properties.filledColors) { if (typeof properties.filledColors == 'object' && properties.filledColors[j]) { var fill = properties.filledColors[j]; } else if (typeof properties.filledColors == 'object' && properties.filledColors.toString().indexOf('Gradient') > 0) { var fill = properties.filledColors; } else if (typeof properties.filledColors == 'string') { var fill = properties.filledColors; } } else if (properties.filled) { var fill = properties.colors[j]; } else { var fill = null; }
            if (properties.tickmarksStyle && typeof properties.tickmarksStyle == 'object') { var tickmarks = properties.tickmarksStyle[i]; } else if (properties.tickmarksStyle && typeof properties.tickmarksStyle == 'string') { var tickmarks = properties.tickmarksStyle; } else if (properties.tickmarksStyle && typeof properties.tickmarksStyle == 'function') { var tickmarks = properties.tickmarksStyle; } else { var tickmarks = null; }
            if (properties.outofboundsClip) { this.path('sa b r % % % % cl b', 0, this.marginTop, this.canvas.width, this.canvas.height - this.marginTop - this.marginBottom); }
            this.drawLine(this.data[i], properties.colors[j], fill, this.getLineWidth(j), tickmarks, i);
            if (properties.outofboundsClip) { this.context.restore(); }
            this.context.stroke();
        }
        if (properties.outofboundsClip) { this.path('sa b r % % % % cl b', 0, this.marginTop, this.canvas.width, this.canvas.height - this.marginTop - this.marginBottom); }
        if (properties.filled && properties.filledAccumulative && !properties.spline) {
            for (var i = 0; i < this.coords2.length; ++i) {
                this.context.beginPath();
                this.context.lineWidth = this.getLineWidth(i);
                this.context.strokeStyle = !this.hidden(i) ? properties.colors[i] : 'rgba(0,0,0,0)';
                for (var j = 0, len = this.coords2[i].length; j < len; ++j) {
                    if (j == 0 || this.coords2[i][j][1] == null || (this.coords2[i][j - 1] && this.coords2[i][j - 1][1] == null)) { this.context.moveTo(this.coords2[i][j][0], this.coords2[i][j][1]); } else {
                        if (properties.stepped) { this.context.lineTo(this.coords2[i][j][0], this.coords2[i][j - 1][1]); }
                        this.context.lineTo(this.coords2[i][j][0], this.coords2[i][j][1]);
                    }
                }
                this.context.stroke();
            }
            if (properties.tickmarksStyle) {
                this.context.beginPath();
                this.context.fillStyle = 'white';
                for (var i = 0, len = this.coords2.length; i < len; ++i) {
                    this.context.beginPath();
                    this.context.strokeStyle = properties.colors[i];
                    for (var j = 0; j < this.coords2[i].length; ++j) {
                        if (typeof this.coords2[i][j] == 'object' && typeof this.coords2[i][j][0] == 'number' && typeof this.coords2[i][j][1] == 'number') {
                            var tickmarks = typeof properties.tickmarksStyle == 'object' ? properties.tickmarksStyle[i] : properties.tickmarksStyle;
                            this.drawTick(this.coords2[i], this.coords2[i][j][0], this.coords2[i][j][1], this.context.strokeStyle, false, j == 0 ? 0 : this.coords2[i][j - 1][0], j == 0 ? 0 : this.coords2[i][j - 1][1], tickmarks, j, i);
                        }
                    }
                }
                this.context.stroke();
                this.context.fill();
            }
        } else if (properties.filled && properties.filledAccumulative && properties.spline) {
            for (var i = 0; i < this.coordsSpline.length; i += 1) {
                this.context.beginPath();
                this.context.strokeStyle = properties.colors[i];
                this.context.lineWidth = this.getLineWidth(i);
                for (var j = 0, len = this.coordsSpline[i].length; j < len; j += 1) {
                    var point = this.coordsSpline[i][j];
                    j == 0 ? this.context.moveTo(point[0], point[1]) : this.context.lineTo(point[0], point[1]);
                }
                this.context.stroke();
            }
            for (var i = 0, len = this.coords2.length; i < len; i += 1) {
                for (var j = 0, len2 = this.coords2[i].length; j < len2; ++j) {
                    if (typeof this.coords2[i][j] == 'object' && typeof this.coords2[i][j][0] == 'number' && typeof this.coords2[i][j][1] == 'number') {
                        var tickmarks = typeof properties.tickmarksStyle == 'object' && !RGraph.isNull(properties.tickmarksStyle) ? properties.tickmarksStyle[i] : properties.tickmarksStyle;
                        this.context.strokeStyle = properties.colors[i];
                        this.drawTick(this.coords2[i], this.coords2[i][j][0], this.coords2[i][j][1], properties.colors[i], false, j == 0 ? 0 : this.coords2[i][j - 1][0], j == 0 ? 0 : this.coords2[i][j - 1][1], tickmarks, j, i);
                    }
                }
            }
        }
        if (properties.nullBridge) { for (var i = 0; i < this.data.length; ++i) { this.nullBridge(i, this.data[i]); } }
        if (properties.outofboundsClip) { this.context.restore(); }
        this.context.restore();
        this.context.beginPath();
        if (properties.axesAbove) { this.drawAxes(); }
        this.drawLabels();
        this.drawRange();
        if (properties.key && properties.key.length && RGraph.drawKey) { RGraph.drawKey(this, properties.key, properties.colors); }
        if (properties.labelsAbove) { this.drawAboveLabels(); }
        RGraph.drawInGraphLabels(this);
        if (properties.filled && properties.filledRange && this.data.length == 2) {
            this.context.beginPath();
            var len = this.coords.length / 2;
            this.context.lineWidth = properties.linewidth;
            this.context.strokeStyle = this.hidden(0) ? 'rgba(0,0,0,0)' : properties.colors[0];
            for (var i = 0; i < len; ++i) { if (!RGraph.isNull(this.coords[i][1])) { if (i == 0) { this.context.moveTo(this.coords[i][0], this.coords[i][1]); } else { this.context.lineTo(this.coords[i][0], this.coords[i][1]); } } }
            this.context.stroke();
            this.context.beginPath();
            if (properties.colors[1]) { this.context.strokeStyle = this.hidden(1) ? 'rgba(0,0,0,0)' : properties.colors[1]; }
            for (var i = this.coords.length - 1; i >= len; --i) { if (!RGraph.isNull(this.coords[i][1])) { if (i == (this.coords.length - 1)) { this.context.moveTo(this.coords[i][0], this.coords[i][1]); } else { this.context.lineTo(this.coords[i][0], this.coords[i][1]); } } }
            this.context.stroke();
        } else if (properties.filled && properties.filledRange) { alert('[LINE] You must have only two sets of data for a filled range chart'); }
        for (var i = 0; i < this.data.length; ++i) { if ((RGraph.isArray(properties.trendline) && properties.trendline[i]) || (!RGraph.isArray(properties.trendline) && properties.trendline)) { this.drawTrendline(i); } }
        RGraph.installEventListeners(this);
        if (properties.tooltipsDataset) { this.addDatasetTooltip(); }
        if (this.firstDraw) {
            this.firstDraw = false;
            RGraph.fireCustomEvent(this, 'onfirstdraw');
            this.firstDrawFunc();
        }
        RGraph.fireCustomEvent(this, 'ondraw');
        return this;
    };
    this.exec = function(func) { func(this); return this; };
    this.drawAxes = function() {
        this.context.beginPath();
        RGraph.drawXAxis(this);
        RGraph.drawYAxis(this);
        this.context.beginPath();
    };
    this.drawLabels = function() {};
    this.drawLine = function(lineData, color, fill, linewidth, tickmarks, index) {
        if (properties.animationUnfoldY && properties.animationFactor != 1) { for (var i = 0; i < lineData.length; ++i) { lineData[i] *= properties.animationFactor; } }
        var penUp = false;
        var yPos = null;
        var xPos = 0;
        this.context.lineWidth = 1;
        var lineCoords = [];
        if (index > 0) { var prevLineCoords = this.coords2[index - 1]; }
        this.setLinecap({ index: index });
        this.setLinejoin({ index: index });
        var xInterval = (this.canvas.width - (2 * properties.marginInner) - this.marginLeft - this.marginRight) / (lineData.length - 1);
        for (i = 0, len = lineData.length; i < len; i += 1) {
            var data_point = lineData[i];
            var yPos = this.getYCoord(data_point);
            if (lineData[i] == null || (properties.xaxisPosition == 'bottom' && lineData[i] < this.min && !properties.outofbounds) || (properties.xaxisPosition == 'center' && lineData[i] < (-1 * this.max) && !properties.outofbounds) || (((lineData[i] < this.min && properties.xaxisPosition !== 'center') || lineData[i] > this.max) && !properties.outofbounds)) { yPos = null; }
            if (i > 0) { xPos = xPos + xInterval; } else { xPos = properties.marginInner + this.marginLeft; }
            if (properties.animationUnfoldX) { xPos *= properties.animationFactor; if (xPos < properties.marginLeft) { xPos = properties.marginLeft; } }
            this.coords.push([xPos, yPos]);
            lineCoords.push([xPos, yPos]);
        }
        this.context.stroke();
        this.coords2[index] = lineCoords;
        this.context.beginPath();
        this.context.strokeStyle = 'rgba(0,0,0,0)';
        if (fill) { this.context.fillStyle = fill; }
        var isStepped = properties.stepped;
        var isFilled = properties.filled;
        if (properties.xaxisPosition == 'top') { var xAxisPos = this.marginTop; } else if (properties.xaxisPosition == 'center') { var xAxisPos = this.marginTop + (this.grapharea / 2); } else if (properties.xaxisPosition == 'bottom') { var xAxisPos = this.getYCoord(properties.yaxisScaleMin) }
        for (var i = 0, len = lineCoords.length; i < len; i += 1) {
            xPos = lineCoords[i][0];
            yPos = lineCoords[i][1];
            var set = index;
            var prevY = (lineCoords[i - 1] ? lineCoords[i - 1][1] : null);
            var isLast = (i + 1) == lineCoords.length;
            if (!properties.outofbounds && (prevY < this.marginTop || prevY > (this.canvas.height - this.marginBottom))) { penUp = true; }
            if (i == 0 || penUp || !yPos || !prevY || prevY < this.marginTop) {
                if (properties.filled && !properties.filledRange) {
                    if (!properties.outofbounds || prevY === null || yPos === null) { this.context.moveTo(xPos + 1, xAxisPos); }
                    if (properties.xaxisPosition == 'top') { this.context.moveTo(xPos + 1, xAxisPos); }
                    if (isStepped && i > 0) { this.context.lineTo(xPos, lineCoords[i - 1][1]); }
                    this.context.lineTo(xPos, yPos);
                } else { if (RGraph.ISOLD && yPos == null) {} else { this.context.moveTo(xPos + 1, yPos); } }
                if (yPos == null) { penUp = true; } else { penUp = false; }
            } else {
                if (isStepped) { this.context.lineTo(xPos, lineCoords[i - 1][1]); }
                if ((yPos >= this.marginTop && yPos <= (this.canvas.height - this.marginBottom)) || properties.outofbounds) {
                    if (isLast && properties.filled && !properties.filledRange && properties.yaxisPosition == 'right') { xPos -= 1; }
                    if (!isStepped || !isLast) { this.context.lineTo(xPos, yPos); if (isFilled && lineCoords[i + 1] && lineCoords[i + 1][1] == null) { this.context.lineTo(xPos, xAxisPos); } } else if (isStepped && isLast) { this.context.lineTo(xPos, yPos); }
                    penUp = false;
                } else { penUp = true; }
            }
        }
        if (properties.filled && !properties.filledRange && !properties.spline) {
            var fillStyle = properties.filledColors;
            if (index > 0 && properties.filledAccumulative) { this.context.lineTo(xPos, prevLineCoords ? prevLineCoords[i - 1][1] : (this.canvas.height - this.marginBottom - 1 + (properties.xaxisPosition == 'center' ? (this.canvas.height - this.marginTop - this.marginBottom) / 2 : 0))); for (var k = (i - 1); k >= 0; --k) { this.context.lineTo(k == 0 ? prevLineCoords[k][0] + 1 : prevLineCoords[k][0], prevLineCoords[k][1]); } } else {
                if (properties.xaxisPosition == 'top') {
                    this.context.lineTo(xPos, properties.marginTop + 1);
                    this.context.lineTo(lineCoords[0][0], properties.marginTop + 1);
                } else if (typeof lineCoords[i - 1][1] == 'number') {
                    var yPosition = this.getYCoord(0);
                    this.context.lineTo(xPos, yPosition);
                    this.context.lineTo(lineCoords[0][0], yPosition);
                }
            }
            this.context.fillStyle = !this.hidden(index) ? fill : 'rgba(0,0,0,0)';
            this.context.fill();
            this.context.beginPath();
        }
        this.context.stroke();
        if (properties.backdrop) { this.drawBackdrop(lineCoords, color); }
        this.context.save();
        this.context.beginPath();
        if (properties.animationTraceCenter) { this.context.rect((this.canvas.width / 2) * (1 - properties.animationTraceClip), 0, this.canvas.width * properties.animationTraceClip, this.canvas.height); } else { this.context.rect(0, 0, this.canvas.width * properties.animationTraceClip, this.canvas.height); }
        this.context.clip();
        if (typeof properties.errorbars !== 'null') { this.drawErrorbars(); }
        this.setShadow(index);
        this.redrawLine(lineCoords, color, linewidth, index);
        this.context.stroke();
        RGraph.noShadow(this);
        for (var i = 0; i < lineCoords.length; ++i) {
            i = Number(i);
            this.context.strokeStyle = color;
            if (isStepped && i == (lineCoords.length - 1)) { this.context.beginPath(); }
            if ((tickmarks != 'endcircle' && tickmarks != 'endsquare' && tickmarks != 'filledendsquare' && tickmarks != 'endtick' && tickmarks != 'endtriangle' && tickmarks != 'arrow' && tickmarks != 'filledarrow') || (i == 0 && tickmarks != 'arrow' && tickmarks != 'filledarrow') || i == (lineCoords.length - 1)) {
                var prevX = (i <= 0 ? null : lineCoords[i - 1][0]);
                var prevY = (i <= 0 ? null : lineCoords[i - 1][1]);
                this.drawTick(lineData, lineCoords[i][0], lineCoords[i][1], color, false, prevX, prevY, tickmarks, i, index);
            }
        }
        this.context.restore();
        this.drawAngledLabels();
        this.context.beginPath();
        this.context.arc(this.canvas.width + 50000, this.canvas.height + 50000, 2, 0, 6.38, 1);
    };
    this.drawTick = function(lineData, xPos, yPos, color, isShadow, prevX, prevY, tickmarks, index, dataset) {
        if (properties.tickmarksColor) { color = properties.tickmarksColor; }
        if (this.hidden(dataset)) { return; } else if (RGraph.isNull(yPos)) { return false; } else if ((yPos > (this.canvas.height - this.marginBottom)) && !properties.outofbounds) { return; } else if ((yPos < this.marginTop) && !properties.outofbounds) { return; }
        this.context.beginPath();
        var offset = 0;
        this.path('lw % ss % fs %', properties.tickmarksLinewidth ? properties.tickmarksLinewidth : properties.linewidth, isShadow ? properties.shadowColor : color, isShadow ? properties.shadowColor : color);
        if (tickmarks == 'circle' || tickmarks == 'round' || tickmarks == 'filledcircle' || tickmarks == 'endcircle' || tickmarks === 'filledendcircle') {
            if (tickmarks == 'round' || tickmarks == 'circle' || tickmarks == 'filledcircle' || ((tickmarks == 'endcircle' || tickmarks === 'filledendcircle') && (index == 0 || index == (lineData.length - 1)))) {
                this.path('b a % % % % % %', xPos + offset, yPos + offset, properties.tickmarksSize, 0, 360 / (180 / RGraph.PI), false);
                if (tickmarks.indexOf('filled') !== -1) { this.path('fs %', isShadow ? properties.shadowColor : color); } else { this.path('fs %', isShadow ? properties.shadowColor : 'white'); }
                this.context.fill();
                this.context.stroke();
            }
        } else if (tickmarks == 'halftick') { this.path('b m % % l % % s null', Math.round(xPos), yPos, Math.round(xPos), yPos + properties.tickmarksSize); } else if (tickmarks == 'tick') { this.path('b m % % l % % s', Math.round(xPos), yPos - properties.tickmarksSize, Math.round(xPos), yPos + properties.tickmarksSize); } else if (tickmarks == 'endtick' && (index == 0 || index == (lineData.length - 1))) { this.path('b m % % l % % s', Math.round(xPos), yPos - properties.tickmarksSize, Math.round(xPos), yPos + properties.tickmarksSize); } else if (tickmarks == 'cross') {
            var ticksize = properties.tickmarksSize;
            this.path('b m % % l % % m % % l % % s %', xPos - ticksize, yPos - ticksize, xPos + ticksize, yPos + ticksize, xPos + ticksize, yPos - ticksize, xPos - ticksize, yPos + ticksize, color);
        } else if (tickmarks == 'triangle' || tickmarks == 'filledtriangle' || (tickmarks == 'endtriangle' && (index == 0 || index == (lineData.length - 1)))) { this.path('b m % % l % % l % % c f % s null', Math.round(xPos - properties.tickmarksSize), yPos + properties.tickmarksSize, Math.round(xPos), yPos - properties.tickmarksSize, Math.round(xPos + properties.tickmarksSize), yPos + properties.tickmarksSize, tickmarks === 'filledtriangle' ? (isShadow ? properties.shadowColor : this.context.strokeStyle) : 'white'); } else if (tickmarks == 'borderedcircle' || tickmarks == 'dot') { this.path('lw % b a % % % % % false c f % s %', properties.tickmarksStyleDotLinewidth || 0.00000001, xPos, yPos, properties.tickmarksSize, 0, 360 / (180 / RGraph.PI), properties.tickmarksStyleDotFill || color, properties.tickmarksStyleDotStroke || color); } else if (tickmarks == 'square' || tickmarks == 'rect' || tickmarks == 'filledsquare' || (tickmarks == 'endsquare' && (index == 0 || index == (lineData.length - 1))) || (tickmarks == 'filledendsquare' && (index == 0 || index == (lineData.length - 1)))) {
            this.path('b r % % % % f % s %', Math.round(xPos - properties.tickmarksSize), Math.round(yPos - properties.tickmarksSize), properties.tickmarksSize * 2, properties.tickmarksSize * 2, 'white', this.context.strokeStyle);
            if (tickmarks == 'filledsquare' || tickmarks == 'filledendsquare') { this.path('b r % % % % f %', Math.round(xPos - properties.tickmarksSize), Math.round(yPos - properties.tickmarksSize), properties.tickmarksSize * 2, properties.tickmarksSize * 2, isShadow ? properties.shadowColor : this.context.strokeStyle); }
            this.path('f null s null');
        } else if (tickmarks === 'diamond' || tickmarks === 'filleddiamond' || (tickmarks === 'enddiamond' && (index == 0 || index == (lineData.length - 1))) || (tickmarks === 'filledenddiamond' && (index == 0 || index == (lineData.length - 1)))) { this.path('b m % % l % % l % % l % % c f % s', xPos - properties.tickmarksSize, yPos, xPos, yPos - properties.tickmarksSize, xPos + properties.tickmarksSize, yPos, xPos, yPos + properties.tickmarksSize, tickmarks.substr(0, 6) === 'filled' ? (isShadow ? properties.shadowColor : this.context.strokeStyle) : 'white'); } else if (tickmarks == 'filledarrow') {
            if (properties.spline) {
                xPos = this.coordsSpline[dataset][this.coordsSpline[dataset].length - 1][0];
                yPos = this.coordsSpline[dataset][this.coordsSpline[dataset].length - 1][1];
                prevX = this.coordsSpline[dataset][this.coordsSpline[dataset].length - 3][0];
                prevY = this.coordsSpline[dataset][this.coordsSpline[dataset].length - 3][1];
            }
            var x = Math.abs(xPos - prevX);
            var y = Math.abs(yPos - prevY);
            if (yPos < prevY) { var a = Math.atan(x / y) + 1.57; } else { var a = Math.atan(y / x) + 3.14; }
            this.path('b lj miter m % % a % % % % % false a % % % % % false c s % f %', xPos, yPos, xPos, yPos, properties.tickmarksSize, a - 0.3, a - 0.3, xPos, yPos, properties.tickmarksSize, a + 0.3, a + 0.3, this.context.strokeStyle, this.context.fillStyle);
        } else if (tickmarks === 'arrow') {
            if (properties.spline) {
                xPos = this.coordsSpline[dataset][this.coordsSpline[dataset].length - 1][0];
                yPos = this.coordsSpline[dataset][this.coordsSpline[dataset].length - 1][1];
                prevX = this.coordsSpline[dataset][this.coordsSpline[dataset].length - 2][0];
                prevY = this.coordsSpline[dataset][this.coordsSpline[dataset].length - 2][1];
            }
            var orig_linewidth = this.context.lineWidth;
            var x = Math.abs(xPos - prevX);
            var y = Math.abs(yPos - prevY);
            this.context.lineWidth;
            if (yPos < prevY) { var a = Math.atan(x / y) + 1.57; } else { var a = Math.atan(y / x) + 3.14; }
            this.path('b lj miter m % % a % % % % % false m % % a % % % % % false s % lw %', xPos, yPos, xPos, yPos, properties.tickmarksSize, a - 0.3, a - 0.3, xPos, yPos, xPos, yPos, properties.tickmarksSize, a + 0.3, a + 0.3, this.context.strokeStyle, orig_linewidth);
        } else if (typeof tickmarks === 'string' && (tickmarks.substr(0, 6) === 'image:' || tickmarks.substr(0, 5) === 'data:' || tickmarks.substr(0, 1) === '/' || tickmarks.substr(0, 3) === '../' || tickmarks.substr(0, 7) === 'images/' || tickmarks.substr(0, 4) === 'src:')) {
            var img = new Image();
            if (tickmarks.substr(0, 6) === 'image:') { img.src = tickmarks.substr(6); } else if (tickmarks.substr(0, 4) === 'src:') { img.src = tickmarks.substr(4); } else { img.src = tickmarks; }
            var obj = this;
            img.onload = function() {
                if (properties.tickmarksStyleImageHalign === 'center') xPos -= (this.width / 2);
                if (properties.tickmarksStyleImageHalign === 'right') xPos -= this.width;
                if (properties.tickmarksStyleImageValign === 'center') yPos -= (this.height / 2);
                if (properties.tickmarksStyleImageValign === 'bottom') yPos -= this.height;
                xPos += properties.tickmarksStyleImageOffsetx;
                yPos += properties.tickmarksStyleImageOffsety;
                obj.context.drawImage(this, xPos, yPos);
            };
        } else if (typeof tickmarks == 'function') { tickmarks(this, lineData, lineData[index], index, xPos, yPos, color, prevX, prevY); }
    };
    this.drawRange = function() {
        if (properties.filledRange && properties.filled) {
            if (RGraph.isNull(properties.filledRangeThreshold)) {
                properties.filledRangeThreshold = this.ymin
                properties.filledRangeThresholdColors = [properties.filledColors, properties.filledColors]
            }
            for (var idx = 0; idx < 2; ++idx) {
                var threshold_colors = properties.filledRangeThresholdColors;
                var y = this.getYCoord(properties.filledRangeThreshold)
                this.context.save();
                if (idx == 0) {
                    this.context.beginPath();
                    this.context.rect(0, 0, this.canvas.width, y);
                    this.context.clip();
                } else {
                    this.context.beginPath();
                    this.context.rect(0, y, this.canvas.width, this.canvas.height);
                    this.context.clip();
                }
                this.context.beginPath();
                this.context.fillStyle = (idx == 1 ? properties.filledRangeThresholdColors[1] : properties.filledRangeThresholdColors[0]);
                this.context.lineWidth = !this.hidden(idx) ? 1 : 0;
                var len = (this.coords.length / 2);
                for (var i = 0; i < len; ++i) { if (!RGraph.isNull(this.coords[i][1])) { if (i == 0) { this.context.moveTo(this.coords[i][0], this.coords[i][1]) } else { this.context.lineTo(this.coords[i][0], this.coords[i][1]) } } }
                for (var i = this.coords.length - 1; i >= len; --i) { if (RGraph.isNull(this.coords[i][1])) { this.context.moveTo(this.coords[i][0], this.coords[i][1]) } else { this.context.lineTo(this.coords[i][0], this.coords[i][1]) } }
                this.context.fill();
                this.context.restore();
            }
        }
    };
    this.redrawLine = function(coords, color, linewidth, index) {
        if (!properties.redraw || properties.filledRange) { return; }
        this.context.strokeStyle = (typeof color == 'object' && color && color.toString().indexOf('CanvasGradient') == -1 ? color[0] : color);
        this.context.lineWidth = linewidth;
        if (properties.dotted || properties.dashed) { if (properties.dashed) { this.context.setLineDash([2, 6]) } else if (properties.dotted) { this.context.setLineDash([1, 5]) } }
        if (this.hidden(index)) { this.context.strokeStyle = 'rgba(0,0,0,0)'; }
        if (properties.spline) { this.drawCurvyLine(coords, this.hidden(index) ? 'rgba(0,0,0,0)' : color, linewidth, index); return; }
        this.setLinejoin({ index: index });
        this.setLinecap({ index: index });
        this.context.beginPath();
        var len = coords.length;
        var width = this.canvas.width
        var height = this.canvas.height;
        var penUp = false;
        for (var i = 0; i < len; ++i) {
            var xPos = coords[i][0];
            var yPos = coords[i][1];
            if (i > 0) { var prevX = coords[i - 1][0]; var prevY = coords[i - 1][1]; }
            if (((i == 0 && coords[i]) || (yPos < this.marginTop) || (prevY < this.marginTop) || (yPos > (height - this.marginBottom)) || (i > 0 && prevX > (width - this.marginRight)) || (i > 0 && prevY > (height - this.marginBottom)) || prevY == null || penUp == true) && (!properties.outofbounds || yPos == null || prevY == null)) {
                if (RGraph.ISOLD && yPos == null) {} else { this.context.moveTo(coords[i][0], coords[i][1]); }
                penUp = false;
            } else {
                if (properties.stepped && i > 0) { this.context.lineTo(coords[i][0], coords[i - 1][1]); }
                this.context.lineTo(coords[i][0], coords[i][1]);
                penUp = false;
            }
        }
        if (properties.colorsAlternate && typeof color == 'object' && color[0] && color[1]) {
            for (var i = 1; i < len; ++i) {
                var prevX = coords[i - 1][0];
                var prevY = coords[i - 1][1];
                if (prevY != null && coords[i][1] != null) {
                    this.context.beginPath();
                    this.context.strokeStyle = color[coords[i][1] < prevY ? 0 : 1];
                    this.context.lineWidth = properties.linewidth;
                    this.context.moveTo(prevX, prevY);
                    this.context.lineTo(coords[i][0], coords[i][1]);
                    this.context.stroke();
                }
            }
        }
        this.context.stroke();
        this.context.beginPath();
        if (properties.dashed || properties.dotted) { this.context.setLineDash([1, 0]); }
    };
    this.drawBackdrop = function(coords, color) {
        var size = properties.backdropSize;
        this.context.lineWidth = size;
        this.context.globalAlpha = properties.backdropAlpha;
        this.context.strokeStyle = color;
        var yCoords = [];
        this.context.beginPath();
        if (properties.spline && !RGraph.ISOLD) {
            for (var i = 0; i < coords.length; ++i) { yCoords.push(coords[i][1]) }
            this.drawSpline(this.context, yCoords, color, null);
        } else { this.context.moveTo(coords[0][0], coords[0][1]); for (var j = 1; j < coords.length; ++j) { this.context.lineTo(coords[j][0], coords[j][1]); } }
        this.context.stroke();
        this.context.globalAlpha = 1;
        RGraph.noShadow(this);
    };
    this.getLineWidth = function(i) {
        var linewidth = properties.linewidth;
        if (typeof linewidth == 'number') { return linewidth; } else if (typeof linewidth === 'object') {
            if (linewidth[i]) { return linewidth[i]; } else { return linewidth[0]; }
            alert('[LINE] Error! The linewidth option should be a single number or an array of one or more numbers');
        }
    };
    this.getShape = function(e) {
        var obj = this,
            mouseXY = RGraph.getMouseXY(e),
            mouseX = mouseXY[0],
            mouseY = mouseXY[1];
        if (arguments[1]) { obj = arguments[1]; }
        for (var i = 0; i < obj.coords.length; ++i) {
            var x = obj.coords[i][0],
                y = obj.coords[i][1],
                dataset = 0,
                idx = i;
            while ((idx + 1) > this.data[dataset].length) {
                idx -= this.data[dataset].length;
                dataset++;
            }
            if (mouseX <= (x + properties.tooltipsHotspotSize) && mouseX >= (x - properties.tooltipsHotspotSize) && mouseY <= (y + properties.tooltipsHotspotSize) && mouseY >= (y - properties.tooltipsHotspotSize)) {
                if (RGraph.parseTooltipText) { var tooltip = RGraph.parseTooltipText(properties.tooltips, i); }
                if (this.hidden(dataset)) { continue; }
                return { object: obj, x: x, y: y, dataset: dataset, index: idx, sequentialIndex: i, label: properties.xaxisLabels && typeof properties.xaxisLabels[idx] === 'string' ? properties.xaxisLabels[idx] : null, tooltip: typeof tooltip === 'string' ? tooltip : null };
            } else if (properties.tooltipsHotspotXonly == true && mouseX <= (x + properties.tooltipsHotspotSize) && mouseX >= (x - properties.tooltipsHotspotSize)) { var tooltip = RGraph.parseTooltipText(properties.tooltips, i); return { object: obj, x: x, y: y, dataset: dataset, index: idx, sequentialIndex: i, label: properties.xaxisLabels && typeof properties.xaxisLabels[idx] === 'string' ? properties.xaxisLabels[idx] : null, tooltip: tooltip }; }
        }
    };
    this.getShapeByX = function(e) {
        var obj = this,
            mouseXY = RGraph.getMouseXY(e),
            mouseX = mouseXY[0],
            mouseY = mouseXY[1];
        if (arguments[1]) { obj = arguments[1]; }
        for (var i = 0; i < obj.coords.length; ++i) {
            var x = obj.coords[i][0],
                y = obj.coords[i][1],
                dataset = 0,
                idx = i;
            while ((idx + 1) > this.data[dataset].length) {
                idx -= this.data[dataset].length;
                dataset++;
            }
            if (mouseX <= (x + properties.tooltipsHotspotSize) && mouseX >= (x - properties.tooltipsHotspotSize)) { return { object: obj, x: x, y: y, dataset: dataset, index: idx, sequentialIndex: i, label: properties.xaxisLabels && typeof properties.xaxisLabels[idx] === 'string' ? properties.xaxisLabels[idx] : null }; }
        }
    };
    this.drawAboveLabels = function() {
        var units_pre = properties.labelsAboveUnitsPre,
            units_post = properties.labelsAboveUnitsPost,
            decimals = properties.labelsAboveDecimals,
            point = properties.labelsAbovePoint,
            thousand = properties.labelsAboveThousand,
            bgcolor = properties.labelsAboveBackground || 'white',
            border = ((typeof properties.labelsAboveBorder === 'boolean' || typeof properties.labelsAboveBorder === 'number') ? properties.labelsAboveBorder : true),
            offsety = properties.labelsAboveOffsety,
            specific = properties.labelsAboveSpecific;
        var textConf = RGraph.getTextConf({ object: this, prefix: 'labelsAbove' });
        offsety -= textConf.size;
        this.context.beginPath();
        for (var i = 0, len = this.coords.length; i < len; i += 1) {
            var indexes = RGraph.sequentialIndexToGrouped(i, this.data),
                dataset = indexes[0],
                index = indexes[1],
                coords = this.coords[i];
            if (RGraph.isNull(coords[1])) { continue; }
            if (this.hidden(dataset)) { continue; }
            RGraph.text({ object: this, font: textConf.font, size: textConf.size, color: textConf.color, bold: textConf.bold, italic: textConf.italic, x: coords[0] + properties.labelsAboveOffsetx, y: coords[1] + offsety, text: (specific && specific[i]) ? specific[i] : (specific ? '' : RGraph.numberFormat({ object: this, number: typeof decimals === 'number' ? this.data_arr[i].toFixed(decimals) : this.data_arr[i], unitspre: units_pre, unitspost: units_post, point: point, thousand: thousand })), valign: 'center', halign: 'center', bounding: true, boundingFill: bgcolor, boundingStroke: border ? 'black' : 'rgba(0,0,0,0)', tag: 'labels.above' });
        }
    };
    this.drawCurvyLine = function(coords, color, linewidth, index) {
        var yCoords = [];
        for (var i = 0; i < coords.length; ++i) { yCoords.push(coords[i][1]); }
        if (properties.filled) {
            this.context.beginPath();
            var xaxisY = this.getYCoord(properties.yaxisScaleMin);
            this.context.moveTo(coords[0][0], xaxisY);
            this.drawSpline(this.context, yCoords, color, index);
            if (properties.filledAccumulative && index > 0) { for (var i = (this.coordsSpline[index - 1].length - 1); i >= 0; i -= 1) { this.context.lineTo(this.coordsSpline[index - 1][i][0], this.coordsSpline[index - 1][i][1]); } } else { this.context.lineTo(coords[coords.length - 1][0], xaxisY); }
            this.context.fill();
        }
        this.context.beginPath();
        this.drawSpline(this.context, yCoords, color, index);
        this.context.stroke();
    };
    this.getValue = function(arg) {
        if (arg.length == 2) { var mouseX = arg[0]; var mouseY = arg[1]; } else { var mouseCoords = RGraph.getMouseXY(arg); var mouseX = mouseCoords[0]; var mouseY = mouseCoords[1]; }
        var obj = this;
        var xaxispos = properties.xaxisPosition;
        if (mouseY < properties.marginTop) { return xaxispos == 'bottom' || xaxispos == 'center' ? this.max : this.min; } else if (mouseY > (this.canvas.height - properties.marginBottom)) { return xaxispos == 'bottom' ? this.min : this.max; }
        if (properties.xaxisPosition == 'center') {
            var value = (((obj.grapharea / 2) - (mouseY - properties.marginTop)) / obj.grapharea) * (obj.max - obj.min);
            value *= 2;
            value > 0 ? value += this.min : value -= this.min;
            return value;
        } else if (properties.xaxisPosition == 'top') {
            var value = ((obj.grapharea - (mouseY - properties.marginTop)) / obj.grapharea) * (obj.max - obj.min);
            value = Math.abs(obj.max - value) * -1;
            return value;
        } else {
            var value = ((obj.grapharea - (mouseY - properties.marginTop)) / obj.grapharea) * (obj.max - obj.min)
            value += obj.min;
            return value;
        }
    };
    this.highlight = function(shape) {
        if (properties.tooltipsHighlight) {
            if (typeof properties.highlightStyle === 'function') {
                (properties.highlightStyle)(shape);
            } else if (properties.highlightStyle === 'invert') {
                this.path('sa b r % % % % cl', properties.marginLeft, properties.marginTop, this.canvas.width - properties.marginLeft - properties.marginRight, this.canvas.height - properties.marginTop - properties.marginBottom);
                this.path('b m % % a % % 25 4.71 4.72 true l % % l % % l % % l % % l % % c f %', shape.x, properties.marginTop, shape.x, shape.y, shape.x, properties.marginTop, this.canvas.width - properties.marginRight, properties.marginTop, this.canvas.width - properties.marginRight, this.canvas.height - properties.marginBottom, properties.marginLeft, this.canvas.height - properties.marginBottom, properties.marginLeft, properties.marginTop, properties.highlightFill);
                this.path('b a % % 25 0 6.29 false s % rs', shape.x, shape.y, properties.highlightStroke);
            } else if (properties.highlightStyle === 'halo') {
                var obj = shape.object,
                    color = properties.colors[shape.dataset];
                obj.path('b a % % 13 0 6.2830 false f rgba(255,255,255,0.75)', shape.x, shape.y);
                obj.path('ga 0.15 b a % % 13 0 6.2830 false f % ga 1', shape.x, shape.y, color);
                obj.path('b a % % 7 0 6.2830 false f white', shape.x, shape.y);
                obj.path('b a % % 5 0 6.2830 false f %', shape.x, shape.y, color);
            } else { RGraph.Highlight.point(this, shape); }
        }
    };
    this.getObjectByXY = function(e) { var mouseXY = RGraph.getMouseXY(e); if ((mouseXY[0] > properties.marginLeft - 5) && mouseXY[0] < (this.canvas.width - properties.marginRight + 5) && mouseXY[1] > (properties.marginTop - 5) && mouseXY[1] < (this.canvas.height - properties.marginBottom + 5)) { return this; } };
    this.adjusting_mousemove = function(e) {
        if (properties.adjustable && RGraph.Registry.get('adjusting') && RGraph.Registry.get('adjusting').uid == this.uid) {
            var value = Number(this.getValue(e));
            var shape = RGraph.Registry.get('adjusting.shape');
            if (shape) {
                RGraph.Registry.set('adjusting.shape', shape);
                this.original_data[shape.dataset][shape.index] = Number(value);
                RGraph.redrawCanvas(e.target);
                RGraph.fireCustomEvent(this, 'onadjust');
            }
        }
    };
    this.getYCoord = function(value) {
        if (arguments[1] === true) { var allowOutOfBounds = true; }
        if (typeof value != 'number') { return null; }
        var y;
        var xaxispos = properties.xaxisPosition;
        if (xaxispos == 'top') {
            y = ((value - this.min) / (this.max - this.min)) * this.grapharea;
            if (properties.yaxisScaleInvert) { y = this.grapharea - y; }
            y = y + this.marginTop
        } else if (xaxispos == 'center') {
            y = ((value - this.min) / (this.max - this.min)) * (this.grapharea / 2);
            y = (this.grapharea / 2) - y;
            y += this.marginTop;
        } else {
            if (!allowOutOfBounds && ((value < this.min || value > this.max) && properties.outofbounds == false)) { return null; }
            y = ((value - this.min) / (this.max - this.min)) * this.grapharea;
            if (properties.yaxisScaleInvert) { y = this.grapharea - y; }
            y = this.canvas.height - this.marginBottom - y;
        }
        return y;
    };
    this.drawSpline = function(context, coords, color, index) {
        this.coordsSpline[index] = [];
        var xCoords = [];
        var marginLeft = properties.marginLeft;
        var marginRight = properties.marginRight;
        var hmargin = properties.marginInner;
        var interval = (this.canvas.width - (marginLeft + marginRight) - (2 * hmargin)) / (coords.length - 1);
        this.context.strokeStyle = color;
        for (var i = 0, len = coords.length; i < len; i += 1) { if (typeof coords[i] == 'object' && coords[i] && coords[i].length == 2) { coords[i] = Number(coords[i][1]); } }
        var P = [coords[0]];
        for (var i = 0; i < coords.length; ++i) { P.push(coords[i]); }
        P.push(coords[coords.length - 1] + (coords[coords.length - 1] - coords[coords.length - 2]));
        for (var j = 1; j < P.length - 2; ++j) {
            for (var t = 0; t < 10; ++t) {
                var yCoord = Spline(t / 10, P[j - 1], P[j], P[j + 1], P[j + 2]);
                xCoords.push(((j - 1) * interval) + (t * (interval / 10)) + marginLeft + hmargin);
                this.context.lineTo(xCoords[xCoords.length - 1], yCoord);
                if (typeof index == 'number') { this.coordsSpline[index].push([xCoords[xCoords.length - 1], yCoord]); }
            }
        }
        this.context.lineTo(((j - 1) * interval) + marginLeft + hmargin, P[j]);
        if (typeof index == 'number') { this.coordsSpline[index].push([((j - 1) * interval) + marginLeft + hmargin, P[j]]); }

        function Spline(t, P0, P1, P2, P3) {
            return 0.5 * ((2 * P1) +
                ((0 - P0) + P2) * t +
                ((2 * P0 - (5 * P1) + (4 * P2) - P3) * (t * t) +
                    ((0 - P0) + (3 * P1) - (3 * P2) + P3) * (t * t * t)));
        }
    };
    this.parseColors = function() {
        if (this.original_colors.length === 0) {
            this.original_colors.colors = RGraph.arrayClone(properties.colors);
            this.original_colors.fillledColors = RGraph.arrayClone(properties.filledColors);
            this.original_colors.keyColors = RGraph.arrayClone(properties.keyColors);
            this.original_colors.backgroundBarsColor1 = properties.backgroundBarsColor1;
            this.original_colors.backgroundBarsColor2 = properties.backgroundBarsColor2;
            this.original_colors.backgroundGridColor = properties.backgroundGridColor;
            this.original_colors.backgroundColor = properties.backgroundColor;
            this.original_colors.textColor = properties.textColor;
            this.original_colors.crosshairsColor = properties.crosshairsColor;
            this.original_colors.annotatableColor = properties.annotatableColor;
            this.original_colors.titleColor = properties.titleColor;
            this.original_colors.xaxisTitleColor = properties.xaxisTitleColor;
            this.original_colors.yaxisTitleColor = properties.yaxisTitleColor;
            this.original_colors.keyBackground = properties.keyBackground;
            this.original_colors.axesColor = properties.axesColor;
            this.original_colors.highlightFill = properties.highlightFill;
        }
        for (var i = 0; i < properties.colors.length; ++i) {
            if (typeof properties.colors[i] == 'object' && properties.colors[i][0] && properties.colors[i][1]) {
                properties.colors[i][0] = this.parseSingleColorForGradient(properties.colors[i][0]);
                properties.colors[i][1] = this.parseSingleColorForGradient(properties.colors[i][1]);
            } else { properties.colors[i] = this.parseSingleColorForGradient(properties.colors[i]); }
        }
        if (properties.filledColors) { if (typeof properties.filledColors == 'string') { properties.filledColors = this.parseSingleColorForGradient(properties.filledColors, 'vertical'); } else { for (var i = 0; i < properties.filledColors.length; ++i) { properties.filledColors[i] = this.parseSingleColorForGradient(properties.filledColors[i], 'vertical'); } } }
        if (!RGraph.isNull(properties.keyColors)) { for (var i = 0; i < properties.keyColors.length; ++i) { properties.keyColors[i] = this.parseSingleColorForGradient(properties.keyColors[i]); } }
        var props = ['backgroundBarsColor1', 'backgroundBarsColor2', 'backgroundGridColor', 'backgroundColor', 'crosshairsColor', 'annotatableColor', 'textColor', 'titleColor', 'xaxisTitleColor', 'yaxisTitleColor', 'keyBackground', 'axesColor', 'highlightFill'];
        for (var i = 0; i < props.length; ++i) { properties[props[i]] = this.parseSingleColorForGradient(properties[props[i]]); }
    };
    this.reset = function() {};
    this.parseSingleColorForGradient = function(color) {
        if (!color || typeof color != 'string') { return color; }
        var dir = typeof arguments[1] == 'string' ? arguments[1] : 'vertical';
        if (typeof color === 'string' && color.match(/^gradient\((.*)\)$/i)) {
            if (color.match(/^gradient\(({.*})\)$/i)) { return RGraph.parseJSONGradient({ object: this, def: RegExp.$1 }); }
            var parts = RegExp.$1.split(':');
            if (dir == 'horizontal') { var grad = this.context.createLinearGradient(0, 0, this.canvas.width, 0); } else { var grad = this.context.createLinearGradient(0, this.canvas.height - properties.marginBottom, 0, properties.marginTop); }
            var diff = 1 / (parts.length - 1);
            grad.addColorStop(0, RGraph.trim(parts[0]));
            for (var j = 1; j < parts.length; ++j) { grad.addColorStop(j * diff, RGraph.trim(parts[j])); }
        }
        return grad ? grad : color;
    };
    this.setShadow = function(i) {
        if (properties.shadow) {
            var shadowColor = properties.shadowColor;
            if (typeof shadowColor == 'object' && shadowColor[i - 1]) { this.context.shadowColor = shadowColor[i]; } else if (typeof shadowColor == 'object') { this.context.shadowColor = shadowColor[0]; } else if (typeof shadowColor == 'string') { this.context.shadowColor = shadowColor; }
            this.context.shadowBlur = properties.shadowBlur;
            this.context.shadowOffsetX = properties.shadowOffsetx;
            this.context.shadowOffsetY = properties.shadowOffsety;
        }
    };
    this.interactiveKeyHighlight = function(index) {
        var coords = this.coords2[index];
        if (coords) {
            var pre_linewidth = this.context.lineWidth;
            var pre_linecap = this.context.lineCap;
            this.context.lineWidth = properties.linewidth + 10;
            this.context.lineCap = 'round';
            this.context.strokeStyle = properties.keyInteractiveHighlightChartStroke;
            this.context.beginPath();
            if (properties.spline) { this.drawSpline(this.context, coords, properties.keyInteractiveHighlightChart, null); } else { for (var i = 0, len = coords.length; i < len; i += 1) { if (i == 0 || RGraph.isNull(coords[i][1]) || (typeof coords[i - 1][1] != undefined && RGraph.isNull(coords[i - 1][1]))) { this.context.moveTo(coords[i][0], coords[i][1]); } else { this.context.lineTo(coords[i][0], coords[i][1]); } } }
            this.context.stroke();
            this.context.lineWidth = pre_linewidth;
            this.context.lineCap = pre_linecap;
        }
    };
    this.on = function(type, func) {
        if (type.substr(0, 2) !== 'on') { type = 'on' + type; }
        if (typeof this[type] !== 'function') { this[type] = func; } else { RGraph.addCustomEventListener(this, type, func); }
        return this;
    };
    this.firstDrawFunc = function() {};
    this.drawErrorbars = function() {
        this.context.save();
        RGraph.noShadow(this);
        var coords = this.coords,
            x = 0,
            errorbars = properties.errorbars,
            length = 0;
        if (!properties.errorbarsCapped) {
            properties.errorbarsCappedWidth = 0.001;
            halfwidth = 0.0005;
        }
        this.context.lineWidth = properties.errorbarsLinewidth;
        for (var i = 0; i < coords.length; ++i) {
            var halfwidth = properties.errorbarsCappedWidth / 2 || 5,
                color = properties.errorbarsColor || 'black';
            if (errorbars[i] && typeof errorbars[i][3] === 'number') { this.context.lineWidth = errorbars[i][3]; } else if (typeof properties.errorbarsLinewidth === 'number') { this.context.lineWidth = properties.errorbarsLinewidth; } else { this.context.lineWidth = 1; }
            if (typeof errorbars === 'number' || typeof errorbars[i] === 'number') {
                if (typeof errorbars === 'number') {
                    var positiveLength = this.getYCoord(this.min) - this.getYCoord(this.min + errorbars),
                        negativeLength = positiveLength;
                } else {
                    var positiveLength = this.getYCoord(this.min) - this.getYCoord(this.min + errorbars[i]),
                        negativeLength = positiveLength;
                }
                if (positiveLength || negativeLength) {
                    this.path('lj miter lc square b m % % l % % m % % l % % l % % m % % l % % s %', coords[i][0] - halfwidth, coords[i][1] + negativeLength, coords[i][0] + halfwidth, coords[i][1] + negativeLength, coords[i][0], coords[i][1] + negativeLength, coords[i][0], coords[i][1] - positiveLength, coords[i][0] - halfwidth, coords[i][1] - positiveLength, coords[i][0], coords[i][1] - positiveLength, coords[i][0] + halfwidth, coords[i][1] - positiveLength, color);
                    this.path('lj miter lc square b m % % l % % s %', coords[i][0] - halfwidth, coords[i][1] + negativeLength, coords[i][0] + halfwidth, coords[i][1] + negativeLength, color);
                }
            } else if (typeof errorbars[i] === 'object' && !RGraph.isNull(errorbars[i])) {
                var positiveLength = this.getYCoord(this.min) - this.getYCoord(this.min + errorbars[i][0]),
                    negativeLength = this.getYCoord(this.min) - this.getYCoord(this.min + errorbars[i][1]);
                if (typeof errorbars[i][2] === 'string') { color = errorbars[i][2]; }
                halfwidth = typeof errorbars[i][4] === 'number' ? errorbars[i][4] / 2 : halfwidth;
                if (typeof errorbars[i] === 'object' && typeof errorbars[i][3] === 'number') { this.context.lineWidth = errorbars[i][3]; } else if (typeof properties.errorbarsLinewidth === 'number') { this.context.lineWidth = properties.errorbarsLinewidth; } else { this.context.lineWidth = 1; }
                if (!RGraph.isNull(errorbars[i][0])) { this.path('lc square b  m % % l % % l % % m % % l % % s %', coords[i][0], coords[i][1], coords[i][0], coords[i][1] - positiveLength, coords[i][0] - halfwidth, Math.round(coords[i][1] - positiveLength), coords[i][0], Math.round(coords[i][1] - positiveLength), coords[i][0] + halfwidth, Math.round(coords[i][1] - positiveLength), color); }
                if (typeof errorbars[i][1] === 'number') {
                    var negativeLength = Math.abs(this.getYCoord(errorbars[i][1]) - this.getYCoord(0));
                    this.path('b m % % l % % l % % m % % l % % s %', coords[i][0], coords[i][1], coords[i][0], coords[i][1] + negativeLength, coords[i][0] - halfwidth, Math.round(coords[i][1] + negativeLength), coords[i][0], Math.round(coords[i][1] + negativeLength), coords[i][0] + halfwidth, Math.round(coords[i][1] + negativeLength), color);
                }
            }
        }
        this.context.restore();
    };
    this.hide = function() {
        if (typeof arguments[0] === 'number') { properties.lineVisible[arguments[0]] = false; } else if (typeof arguments[0] === 'object') { for (var i = 0; i < arguments[0].length; ++i) { properties.lineVisible[arguments[0][i]] = false; } } else { for (var i = 0; i < this.original_data.length; ++i) { properties.lineVisible[i] = false; } }
        RGraph.redraw();
        return this;
    };
    this.show = function() {
        if (typeof arguments[0] === 'number') { properties.lineVisible[arguments[0]] = true; } else if (typeof arguments[0] === 'object') { for (var i = 0; i < arguments[0].length; ++i) { properties.lineVisible[arguments[0][i]] = true; } } else { for (var i = 0; i < this.original_data.length; ++i) { properties.lineVisible[i] = true; } }
        RGraph.redraw();
        return this;
    };
    this.hidden = function(index) { return !properties.lineVisible[index]; };
    this.unfold = function() {
        var obj = this,
            opt = arguments[0] ? arguments[0] : {},
            frames = opt.frames ? opt.frames : 30,
            frame = 0,
            callback = arguments[1] ? arguments[1] : function() {},
            initial = properties.animationUnfoldInitial;
        properties.animationFactor = properties.animationUnfoldInitial;

        function iterator() {
            properties.animationFactor = ((1 - initial) * (frame / frames)) + initial;
            RGraph.clear(obj.canvas);
            RGraph.redrawCanvas(obj.canvas);
            if (frame < frames) {
                frame++;
                RGraph.Effects.updateCanvas(iterator);
            } else { callback(obj); }
        }
        iterator();
        return this;
    };
    this.trace = function() {
        var obj = this,
            callback = arguments[2],
            opt = arguments[0] || {},
            frames = opt.frames || 30,
            frame = 0,
            callback = arguments[1] || function() {};
        obj.set('animationTraceClip', 0);

        function iterator() {
            RGraph.clear(obj.canvas);
            RGraph.redrawCanvas(obj.canvas);
            if (frame++ < frames) {
                obj.set('animationTraceClip', frame / frames);
                RGraph.Effects.updateCanvas(iterator);
            } else { callback(obj); }
        }
        iterator();
        return this;
    };
    this.foldtocenter = function() {
        var obj = this,
            opt = arguments[0] || {},
            frames = opt.frames || 30,
            frame = 0,
            callback = arguments[1] || function() {},
            center_value = obj.scale2.max / 2;
        obj.set('yaxisScaleMax', obj.scale2.max);
        var original_data = RGraph.arrayClone(obj.original_data);

        function iterator() {
            for (var i = 0, len = obj.data.length; i < len; ++i) { if (obj.data[i].length) { for (var j = 0, len2 = obj.data[i].length; j < len2; ++j) { var dataset = obj.original_data[i]; if (dataset[j] > center_value) { dataset[j] = original_data[i][j] - ((original_data[i][j] - center_value) * (frame / frames)); } else { dataset[j] = original_data[i][j] + (((center_value - original_data[i][j]) / frames) * frame); } } } }
            RGraph.clear(obj.canvas);
            RGraph.redrawCanvas(obj.canvas)
            if (frame++ < frames) { RGraph.Effects.updateCanvas(iterator); } else { callback(obj); }
        }
        iterator();
        return this;
    };
    this.unfoldfromcentertrace = this.unfoldFromCenterTrace = function() {
        var obj = this,
            opt = arguments[0] || {},
            frames = opt.frames || 30,
            frame = 0,
            data = RGraph.arrayClone(obj.original_data),
            callback = arguments[1] || function() {};
        obj.canvas.style.visibility = 'hidden';
        obj.draw();
        var max = obj.scale2.max;
        RGraph.clear(obj.canvas);
        obj.canvas.style.visibility = 'visible';
        var unfoldCallback = function() {
            obj.original_data = data;
            obj.unfoldFromCenter({ frames: frames / 2 }, callback);
        };
        var half = obj.get('xaxisPosition') == 'center' ? obj.min : ((obj.max - obj.min) / 2) + obj.min;
        obj.set('yaxisScaleMax', obj.max);
        for (var i = 0, len = obj.original_data.length; i < len; ++i) { for (var j = 0; j < obj.original_data[i].length; ++j) { obj.original_data[i][j] = (obj.get('filled') && obj.get('filledAccumulative') && i > 0) ? 0 : half; } }
        RGraph.clear(obj.canvas);
        obj.trace({ frames: frames / 2 }, unfoldCallback);
        return obj;
    };
    this.unfoldfromcenter = this.unfoldFromCenter = function() {
        var obj = this,
            opt = arguments[0] || {},
            frames = opt.frames || 30,
            frame = 0,
            callback = arguments[1] || function() {};
        obj.canvas.style.visibility = 'hidden';
        obj.draw();
        var max = obj.scale2.max;
        RGraph.clear(obj.canvas);
        obj.canvas.style.visibility = 'visible';
        var center_value = obj.get('xaxisPosition') === 'center' ? properties.yaxisScaleMin : ((obj.max - obj.min) / 2) + obj.min,
            original_data = RGraph.arrayClone(obj.original_data),
            steps = null;
        obj.set('yaxisScaleMax', max);
        if (!steps) {
            steps = [];
            for (var dataset = 0, len = original_data.length; dataset < len; ++dataset) {
                steps[dataset] = []
                for (var i = 0, len2 = original_data[dataset].length; i < len2; ++i) {
                    if (properties.filled && properties.filledAccumulative && dataset > 0) {
                        steps[dataset][i] = original_data[dataset][i] / frames;
                        obj.original_data[dataset][i] = center_value;
                    } else {
                        steps[dataset][i] = (original_data[dataset][i] - center_value) / frames;
                        obj.original_data[dataset][i] = center_value;
                    }
                }
            }
        }

        function unfoldFromCenter() {
            for (var dataset = 0; dataset < original_data.length; ++dataset) { for (var i = 0; i < original_data[dataset].length; ++i) { obj.original_data[dataset][i] += steps[dataset][i]; } }
            RGraph.clear(obj.canvas);
            RGraph.redrawCanvas(obj.canvas);
            if (--frames > 0) { RGraph.Effects.updateCanvas(unfoldFromCenter); } else {
                obj.original_data = RGraph.arrayClone(original_data);
                RGraph.clear(obj.canvas);
                RGraph.redrawCanvas(obj.canvas);
                callback(obj);
            }
        }
        unfoldFromCenter();
        return this;
    };
    this.isAdjustable = function(shape) {
        if (RGraph.isNull(properties.adjustableOnly)) { return true; }
        if (RGraph.isArray(properties.adjustableOnly) && properties.adjustableOnly[shape.sequentialIndex]) { return true; }
        return false;
    };
    this.tooltipSubstitutions = function(opt) {
        var indexes = RGraph.sequentialIndexToGrouped(opt.index, this.data);
        if (properties.tooltipsDataset) { return { dataset: indexes[1], index: indexes[0], sequentialIndex: opt.index, values: this.data[indexes[1]] }; } else {
            for (var i = 0, values = []; i < this.original_data.length; ++i) { values.push(this.original_data[i][indexes[1]]); }
            return { index: indexes[1], dataset: indexes[0], sequentialIndex: opt.index, value: this.data_arr[opt.index], values: values };
        }
    };
    this.tooltipsFormattedCustom = function(specific, index) { return {}; };
    this.addDatasetTooltip = function() {
        var obj = this;
        this.datasetTooltipsListener = function(e) {
            var mouseXY = RGraph.getMouseXY(e);
            if (!obj.properties.tooltipsDatasetEvent) { obj.properties.tooltipsDatasetEvent = 'click'; }
            if (obj.properties.spline) { var coords = obj.coordsSpline; } else { var coords = obj.coords2; }
            for (var i = 0; i < coords.length; ++i) {
                var path = 'b lc round lw 10 m {1} {2}'.format(coords[i][0][0], coords[i][0][1]);
                for (var j = 0; j < coords[i].length; ++j) { path += ' l {1} {2}'.format(coords[i][j][0], coords[i][j][1]); }
                obj.path(path);
                if (obj.context.isPointInStroke(mouseXY[0], mouseXY[1])) {
                    var over = true;
                    if (e.type === 'click' || (e.type === 'mousemove' && obj.properties.tooltipsDatasetEvent === 'mousemove' && (!RGraph.Registry.get('tooltip') || i != RGraph.Registry.get('tooltip').__dataset__))) {
                        RGraph.hideTooltip();
                        RGraph.redraw();
                        RGraph.tooltip({ object: obj, text: typeof obj.properties.tooltipsDataset === 'string' ? obj.properties.tooltipsDataset : obj.properties.tooltipsDataset[i], x: mouseXY[0], y: mouseXY[1], index: i, event: e });
                        RGraph.Registry.get('tooltip').__index__ = 0;
                        RGraph.Registry.get('tooltip').__index2__ = 0;
                        RGraph.Registry.get('tooltip').__dataset__ = i;
                        var path = 'b lw %1 m %2 %3'.format(properties.linewidth + 10, coords[i][0][0], coords[i][0][1]);
                        for (var j = 0; j < coords[i].length; ++j) { path += ' l {1} {2}'.format(coords[i][j][0], coords[i][j][1]); }
                        path += ' ga 0.2 s ' + properties.colors[i] + ' ga 1';
                        obj.path(path);
                    }
                    if (e.type === 'mousemove') { e.target.style.cursor = 'pointer'; }
                }
                if (!over) {
                    if (e.type === 'click') {
                        RGraph.hideTooltip();
                        RGraph.redraw();
                    }
                    obj.canvas.style.cursor = 'default';
                }
            }
            e.stopPropagation();
        };
        if (!this.datasetTooltipsListenerAdded) {
            this.canvas.addEventListener('click', this.datasetTooltipsListener, false);
            this.canvas.addEventListener('mousemove', this.datasetTooltipsListener, false);
            window.addEventListener('click', function(e) { RGraph.redraw(); }, false);
            this.datasetTooltipsListenerAdded = true;
        }
    };
    this.positionTooltipStatic = function(args) {
        var obj = args.object,
            e = args.event,
            tooltip = args.tooltip,
            index = args.index,
            canvasXY = RGraph.getCanvasXY(obj.canvas)
        coords = this.coords[args.index];
        args.tooltip.style.left = (canvasXY[0] +
            coords[0] -
            (tooltip.offsetWidth / 2) +
            obj.properties.tooltipsOffsetx) + 'px';
        args.tooltip.style.top = (canvasXY[1] +
            coords[1] -
            tooltip.offsetHeight -
            15 +
            obj.properties.tooltipsOffsety) + 'px';
    };
    this.drawTrendline = function() {
        var args = RGraph.getArgs(arguments, 'dataset');
        var obj = this;
        var color = properties.trendlineColor;
        var linewidth = properties.trendlineLinewidth;
        var margin = properties.trendlineMargin;
        if (properties.trendlineClip) { this.path('b sa r % % % % cl', properties.marginLeft, properties.marginTop, this.canvas.width - properties.marginLeft - properties.marginRight, this.canvas.height - properties.marginTop - properties.marginBottom); }
        var data = [];
        for (var i = 0; i < this.data.length; ++i) { data[i] = []; for (var j = 0; j < this.data[i].length; ++j) { data[i].push([j, this.data[i][j]]); } }
        if (RGraph.isArray(properties.trendlineColors)) { color = properties.trendlineColors; }
        if (typeof color === 'object' && color[args.dataset]) { color = color[args.dataset]; } else if (typeof color === 'object') { color = 'gray'; }
        if (typeof linewidth === 'object' && typeof linewidth[args.dataset] === 'number') { linewidth = linewidth[args.dataset]; } else if (typeof linewidth === 'object') { linewidth = 1; }
        if (typeof margin === 'object' && typeof margin[args.dataset] === 'number') { margin = margin[args.dataset]; } else if (typeof margin === 'object') { margin = 25; }
        for (var i = 0, totalX = 0, totalY = 0; i < this.data[args.dataset].length; ++i) {
            totalX += data[args.dataset][i][0];
            totalY += data[args.dataset][i][1];
        }
        var averageX = totalX / data[args.dataset].length;
        var averageY = totalY / data[args.dataset].length;
        for (var i = 0, xCoordMinusAverageX = [], yCoordMinusAverageY = [], valuesMultiplied = [], xCoordMinusAverageSquared = []; i < this.data[args.dataset].length; ++i) {
            xCoordMinusAverageX[i] = data[args.dataset][i][0] - averageX;
            yCoordMinusAverageY[i] = data[args.dataset][i][1] - averageY;
            valuesMultiplied[i] = xCoordMinusAverageX[i] * yCoordMinusAverageY[i];
            xCoordMinusAverageSquared[i] = xCoordMinusAverageX[i] * xCoordMinusAverageX[i];
        }
        var sumOfValuesMultiplied = RGraph.arraySum(valuesMultiplied);
        var sumOfXCoordMinusAverageSquared = RGraph.arraySum(xCoordMinusAverageSquared);
        var m = sumOfValuesMultiplied / sumOfXCoordMinusAverageSquared;
        var b = averageY - (m * averageX);
        var coords = [
            [0, m * 0 + b],
            [data[0].length - 1, m * (data[0].length - 1) + b]
        ];
        coords[0][0] = this.marginLeft;
        coords[0][1] = this.getYCoord(coords[0][1], true);
        coords[1][0] = this.canvas.width - this.marginRight;
        coords[1][1] = this.getYCoord(coords[1][1], true);
        if (properties.trendlineDashed === true || (RGraph.isArray(properties.trendlineDashed) && properties.trendlineDashed[args.dataset])) { this.context.setLineDash([4, 4]); }
        if (properties.trendlineDotted === true || (RGraph.isArray(properties.trendlineDotted) && properties.trendlineDotted[args.dataset])) { this.context.setLineDash([1, 4]); }
        if (RGraph.isArray(properties.trendlineDashArray)) { if (properties.trendlineDashArray.length === 2 && typeof properties.trendlineDashArray[0] === 'number' && typeof properties.trendlineDashArray[1] === 'number') { this.context.setLineDash(properties.trendlineDashArray); } else if (RGraph.isArray(properties.trendlineDashArray) && RGraph.isArray(properties.trendlineDashArray[args.dataset])) { this.context.setLineDash(properties.trendlineDashArray[args.dataset]); } }
        this.path(' lc round lw % b m % % l % % s %', linewidth, Math.max(coords[0][0], this.coords2[args.dataset][0][0] - margin), coords[0][1], Math.min(coords[1][0], this.coords2[args.dataset][this.coords2[args.dataset].length - 1][0] + margin), coords[1][1], color);
        this.context.setLineDash([5, 0]);
        if (properties.trendlineClip) { this.context.restore(); }
    };
    this.nullBridge = function(datasetIdx, data) {
        var readData = false;
        for (var i = 0; i < data.length; i++) {
            var isNull = false,
                start = null,
                end = null;
            if (readData === false && RGraph.isNumber(data[i])) { readData = true; }
            if (RGraph.isNull(data[i]) && readData) {
                start = i - 1;
                for (var j = (i + 1); j < data.length; ++j) {
                    if (RGraph.isNull(data[j])) { continue; } else { end = j; }
                    this.context.setLineDash(properties.nullBridgeDashArray);
                    this.path('b lw % m % % l % % s %', typeof properties.nullBridgeLinewidth === 'number' ? properties.nullBridgeLinewidth : this.getLineWidth(datasetIdx), this.coords2[datasetIdx][start][0], this.coords2[datasetIdx][start][1], this.coords2[datasetIdx][end][0], this.coords2[datasetIdx][end][1], typeof properties.nullBridgeColors === 'string' ? properties.nullBridgeColors : ((typeof properties.nullBridgeColors === 'object' && !RGraph.isNull(properties.nullBridgeColors) && properties.nullBridgeColors[datasetIdx]) ? properties.nullBridgeColors[datasetIdx] : properties.colors[datasetIdx]));
                    start = null;
                    end = null;
                    break;
                }
            }
        }
    };
    this.drawAngledLabels = function() {
        if (properties.labelsAngled) {
            RGraph.noShadow(this);
            var coords = this.coords;
            var getTextConfiguration = function(dir) {
                var textConf = {};
                var prefixes = ['text', 'labelsAngled', 'labelsAngled' + dir];
                var textProperties = ['Font', 'Color', 'Size', 'Bold', 'Italic'];
                for (var prefix in prefixes) { for (var prop in textProperties) { var name = prefixes[prefix] + textProperties[prop]; if (name) { if (RGraph.isString(properties[name]) || RGraph.isNumber(properties[name]) || RGraph.isBoolean(properties[name])) { textConf[textProperties[prop].toLowerCase()] = properties[name]; } } } }
                return textConf;
            };
            for (var i = 0; i < (coords.length) - 1; ++i) {
                var dx = (coords[i + 1][0] - coords[i][0]) / 2,
                    dy = (coords[i + 1][1] - coords[i][1]) / 2;
                if (coords[i + 1][1] < coords[i][1]) { var direction = 0; var textConf = getTextConfiguration('Up'); } else if (coords[i + 1][1] > coords[i][1]) { var direction = 1; var textConf = getTextConfiguration('Down'); } else { var direction = 2; var textConf = getTextConfiguration('Level'); }
                var angle = RGraph.getAngleByXY({ cx: coords[i][0], cy: coords[i][1], x: coords[i + 1][0], y: coords[i + 1][1], });
                RGraph.text({ object: this, accessible: properties.adjustable ? false : (RGraph.isBoolean(properties.labelsAngledAccessible) ? properties.labelsAngledAccessible : true), font: textConf.font, color: textConf.color, size: textConf.size, bold: textConf.bold, italic: textConf.italic, x: coords[i][0] + dx, y: coords[i][1] + dy - 5, text: (properties.labelsAngledSpecific && (RGraph.isString(properties.labelsAngledSpecific[i]) || RGraph.isNumber(properties.labelsAngledSpecific[i]))) ? properties.labelsAngledSpecific[i] : properties.labelsAngled[direction], halign: 'center', valign: 'bottom', angle: angle * (180 / Math.PI) });
            }
        }
    };
    this.setLinecap = function() { var args = RGraph.getArgs(arguments, 'index'); if (RGraph.isArray(properties.linecap) && RGraph.isString(properties.linecap[args.index])) { this.context.lineCap = properties.linecap[args.index]; } else if (RGraph.isString(properties.linecap)) { this.context.lineCap = properties.linecap; } else { this.context.lineCap = 'round'; } };
    this.setLinejoin = function() { var args = RGraph.getArgs(arguments, 'index'); if (RGraph.isArray(properties.linejoin) && RGraph.isString(properties.linejoin[args.index])) { this.context.lineJoin = properties.linejoin[args.index]; } else if (RGraph.isString(properties.linejoin)) { this.context.lineJoin = properties.linejoin; } else { this.context.lineJoin = 'round'; } };
    RGraph.register(this);
    for (var i = 0; i < this.original_data.length; ++i) { properties.lineVisible[i] = true; }
    RGraph.parseObjectStyleConfig(this, conf.options);
};