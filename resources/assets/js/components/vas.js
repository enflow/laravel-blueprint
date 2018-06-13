$(function () {
    if (!$(".graph-container").length) return;

    //http://www.html5canvastutorials.com/tutorials/html5-canvas-line-width/
    function setCross(parts) {
        var partSize = 360 / parts;
        for (var n = 0; n < parts; n++) {
            var pos = circleCalc(centerX, centerY, radius, n * partSize);
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
        }
    }

    function circleCalc(centerX, centerY, radius, angle) {
        var radAngle = angle * (Math.PI / 180);
        var x = radius * Math.cos(radAngle) + centerX;
        var y = radius * Math.sin(radAngle) + centerY;
        return {x: x, y: y}
    }

    function setLabels(ctx, partStartDegrees, partEndDegrees, partLabels, partValues, previousPosition) {
        if (typeof closeCircle == "undefined")
            closeCircle = null;

        var degreeArea = partEndDegrees - partStartDegrees;
        var partLength = partValues.length;
        if (partValues && partValues.length) {

        }
        else {
            partValues = null;
        }
        var degreeBetween = degreeArea / partLength;
        var posLatest = null;
        ctx.lineWidth = 3;
        var result = {
            firstx: null,
            firsty: null,
            lastx: null,
            lasty: null
        };
        for (var n = 0; n < partLength; n++) {
            var label = partValues[n].Label;// + ", " + partValues[n].DeepQuestions.join(",");
            var DeepTotal = 0;
            var DeepAnswers = new Array();
            for (var m = 0; partValues[n].DeepQuestions != null && m < partValues[n].DeepQuestions.length; m++) {
                var mydq = partValues[n].DeepQuestions[m].Answer;
                if (mydq == 1)
                    DeepTotal++;
                DeepAnswers.push(mydq);
            }
            partValues[n].DeepYes = DeepTotal;
            //label += ", " + partValues[n].DeepQuestions.length + "/" + DeepTotal;
            //var h = centerX;
            //var k = centerY;
            //var radius = 190;
            var angle = partStartDegrees + n * degreeBetween + (degreeBetween / 2);
            //var radAngle = angle * (Math.PI / 180);
            var pos1 = circleCalc(centerX, centerY, radius - 5, angle);
            var pos2 = circleCalc(centerX, centerY, radius + 5, angle);
            var pos3 = circleCalc(centerX, centerY, radius + 15, angle);
            var pos4 = null;
            var value = null;
            if (partValues != null) {
                value = ((170 / 100) * partValues[n].ResultSecondary) + 10;
                //console.log(value);
                pos4 = circleCalc(centerX, centerY, value, angle);
                if (n == 0) {
                    result.firstx = pos4.x;
                    result.firsty = pos4.y;
                }
            }

            if (pos4 != null) {
                ctx.beginPath();
                ctx.arc(pos4.x, pos4.y, 5, 0, 2 * Math.PI);
                ctx.fillStyle = "#000";
                if (partValues[n].ResultSecondary > 0) {
                    ctx.fill();
                    var calcX = Math.round((pos4.x - centerX + radius) / actionGridPrecision);
                    var calcY = Math.round((pos4.y - centerY + radius) / actionGridPrecision);
                    if (calcX >= 0 && calcY >= 0 && calcX < arrActions.length && calcY < arrActions[0].length) {
                        arrActions[calcX][calcY] = {
                            label: label,
                            posx: pos4.x,
                            posy: pos4.y,
                            value: partValues[n]
                        };
                    }
                }
                //label += " (" + calcX + "," + calcY + ")";
                //label += " (" + value + ")";

                // lijn trekken van latest naar huidig
                if (n == 0 && previousPosition && previousPosition.x != null) {
                    ctx.beginPath();
                    ctx.moveTo(previousPosition.x, previousPosition.y);
                    ctx.lineTo(pos4.x, pos4.y);
                    ctx.stroke();
                }
                if (posLatest != null) {
                    ctx.beginPath();
                    ctx.moveTo(pos4.x, pos4.y);
                    ctx.lineTo(posLatest.x, posLatest.y);
                    ctx.stroke();
                }
                posLatest = {x: pos4.x, y: pos4.y}
            }
            // line
            ctx.beginPath();
            ctx.moveTo(pos1.x, pos1.y);
            ctx.lineTo(pos2.x, pos2.y);
            ctx.stroke();
            // label
            if (label != null) {
                ctx.font = '12px Verdana';
                ctx.fillStyle = "#000";
                ctx.textBaseline = 'middle';
                ctx.textAlign = pos3.x < centerX ? "right" : "left";
                ctx.fillText(label, pos3.x, pos3.y);
            }

        }
        if (posLatest != null) {
            result.lastx = posLatest.x;
            result.lasty = posLatest.y;
            if (closeCircle != null) // lijn vullen
            {
                ctx.beginPath();
                ctx.moveTo(posLatest.x, posLatest.y);
                ctx.lineTo(closeCircle.x, closeCircle.y);
                ctx.stroke();
            }
        }

        return result;
    }

    function setQuadLabel(angle, labelText) {
        //var angle = partStartDegrees + n * degreeBetween + (degreeBetween / 2);
        //var radAngle = angle * (Math.PI / 180);
        var pos = circleCalc(centerX, centerY, radius + 70, angle);

        ctx.font = 'bold 16px Verdana';
        ctx.fillStyle = "#000";
        ctx.textBaseline = 'middle';
        ctx.textAlign = pos.x < centerX ? "right" : "left";
        ctx.fillText(labelText, pos.x, pos.y);
    }

    function checkActionGrid(valX, valY) {
        if (valX >= 0 && valY >= 0 && valX < arrActions.length && valY < arrActions[0].length) {
            if (arrActions[valX][valY])
                return arrActions[valX][valY];
        }
        return null;
    }

    var centerX = null;
    var centerY = null;
    var radius = null;
    var ctx = null;
    var actionGridPrecision = null;
    var arrActions = null;

    function drawGraph() {
        var c = document.getElementById("spidergraph");
        centerX = $(c).width() / 2;
        centerY = $(c).height() / 2;
        radius = 190;
        actionGridPrecision = 10;
        ctx = c.getContext("2d");

        // create action grid
        arrActions = new Array(radius * 2 / actionGridPrecision);
        for (var n = 0; n < arrActions.length; n++) {
            arrActions[n] = new Array(arrActions.length);
        }

        ctx.beginPath();
        ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);

        var grd = ctx.createRadialGradient(centerX, centerY, 30, centerX, centerY, 220);
        grd.addColorStop(0, "#ff0000");
        grd.addColorStop(.5, "#ffff00");
        grd.addColorStop(1, "#00c000");

        // Fill with gradient
        ctx.fillStyle = grd;
        ctx.fill();
        ctx.stroke();

        setCross(4);

        var lastPos = null;

        var rawData = $(".js-results-json").html();
        var _graphData = jQuery.parseJSON(rawData);
        var objResultCat = new Object();
        //var arrCats = new Array();
        for (var gc = 0; gc < _graphData.length; gc++) {
            var gd = _graphData[gc];
            //gd.Label += " " + gd.DeepQuestions.length;
            if (typeof (objResultCat["cat_" + gd.Categoryid]) === "undefined") {
                objResultCat["cat_" + gd.Categoryid] = new Array();
                objResultCat["cat_" + gd.Categoryid].push(gd);
            }
            else
                objResultCat["cat_" + gd.Categoryid].push(gd);
        }

        var Angle = 0;

        // doelgroep: 4
        setQuadLabel(Angle + 60, "Doelgroep");
        var arrValues = [];
        for (var n = 0; n < objResultCat["cat_4"].length; n++) {
            arrValues.push({
                QuestionText: objResultCat["cat_4"][n].QuestionText,
                ResultSecondary: objResultCat["cat_4"][n].ResultSecondary,
                questionid: objResultCat["cat_4"][n].questionid,
                Label: objResultCat["cat_4"][n].Label,
                DeepQuestions: objResultCat["cat_4"][n].DeepQuestions
            });
        }
        lastPos = setLabels(ctx, Angle, Angle + 90, null, arrValues);
        var firstPos = {x: lastPos.firstx, y: lastPos.firsty}; // eerste stip bewaren om te vullen.
        Angle += 90;

        // organisatie: 2
        setQuadLabel(Angle + 30, "Organisatie");
        var arrValues = [];
        for (var n = 0; n < objResultCat["cat_2"].length; n++) {
            arrValues.push({
                QuestionText: objResultCat["cat_2"][n].QuestionText,
                ResultSecondary: objResultCat["cat_2"][n].ResultSecondary,
                questionid: objResultCat["cat_2"][n].questionid,
                Label: objResultCat["cat_2"][n].Label,
                DeepQuestions: objResultCat["cat_2"][n].DeepQuestions
            });
        }
        lastPos = setLabels(ctx, Angle, Angle + 90, null, arrValues, {x: lastPos.lastx, y: lastPos.lasty});

        Angle += 90;

        // interventie: 3
        setQuadLabel(Angle + 60, "Interventie");
        var arrValues = [];
        for (var n = 0; n < objResultCat["cat_3"].length; n++) {
            arrValues.push({
                QuestionText: objResultCat["cat_3"][n].QuestionText,
                ResultSecondary: objResultCat["cat_3"][n].ResultSecondary,
                questionid: objResultCat["cat_3"][n].questionid,
                Label: objResultCat["cat_3"][n].Label,
                DeepQuestions: objResultCat["cat_3"][n].DeepQuestions
            });
        }
        lastPos = setLabels(ctx, Angle, Angle + 90, null, arrValues, {x: lastPos.lastx, y: lastPos.lasty});

        Angle += 90;

        // personeel: 1
        setQuadLabel(Angle + 30, "Personeel");
        var arrValues = [];
        for (var n = 0; n < objResultCat["cat_1"].length; n++) {
            arrValues.push({
                QuestionText: objResultCat["cat_1"][n].QuestionText,
                ResultSecondary: objResultCat["cat_1"][n].ResultSecondary,
                questionid: objResultCat["cat_1"][n].questionid,
                Label: objResultCat["cat_1"][n].Label,
                DeepQuestions: objResultCat["cat_1"][n].DeepQuestions
            });
        }
        lastPos = setLabels(ctx, Angle, Angle + 90, null, arrValues, {x: lastPos.lastx, y: lastPos.lasty}, firstPos);

        $("#spidergraph").bind("mousemove", function (event) {
            var offset = $(this).offset();
            var posX = event.pageX - offset.left;
            var posY = event.pageY - offset.top;
            var newX = (posX - centerX) + radius;
            var newY = (posY - centerY) + radius;
            var calcX = Math.round(newX / actionGridPrecision);
            var calcY = Math.round(newY / actionGridPrecision);
            var ag = checkActionGrid(calcX, calcY);
            if (ag != null) {
                // calculate barpos
                $("#vasvraag").text(ag.value.QuestionText);

                var pos = 100;
                if (ag.value.DeepQuestions != null) {
                    pos = (ag.value.DeepYes / ag.value.DeepQuestions.length) * 100;
                }

                $("#colorgridpointer").css("width", pos + "%");
                $("#scoretip").css({
                    left: (offset.left + ag.posx + 10) + "px",
                    top: (offset.top + ag.posy + 10) + "px"
                }).fadeIn();

                $(this).css("cursor", "pointer");
            }
            else {
                $("#scoretip").fadeOut("fast");
                $(this).css("cursor", "default");
            }
        });
    }

    $(".graph-container").append($("<canvas></canvas>").attr("id", "spidergraph").attr("width", "864px").attr("height", "600px").css({
        width: "864px",
        height: "600px",
        display: "block"
    }));
    drawGraph();
});
