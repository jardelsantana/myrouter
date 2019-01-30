//ORB JavaScript
// DOM Preload
(function ($) {

    "use strict";

    $(document).ready(function () {



        // Preload DOM of Inbox functions:
        inbox();

        // ========================================================================
        //	Togglers
        // ========================================================================

        // toogle sidebar
        $('.left-toggler').click(function (e) {
            $(".responsive-admin-menu").toggleClass("sidebar-toggle");
            $(".content-wrapper").toggleClass("main-content-toggle-left");
            e.preventDefault();
        });

        // We should listen touch elements of touch devices
        $('.smooth-overflow').on('touchstart', function (event) {});

        // toogle sidebar
        $('.right-toggler').click(function (e) {
            $(".main-wrap").toggleClass("userbar-toggle");
            e.preventDefault();
        });

        // toogle chatbar
        $('.chat-toggler').click(function (e) {
            $(".chat-users-menu").toggleClass("chatbar-toggle");
            e.preventDefault();
        });

        // Toggle Chevron in Bootstrap Collapsible Panels
        $('.btn-close').click(function (e) {
            e.preventDefault();
            $(this).parent().parent().parent().fadeOut();
        });

        $('.btn-minmax').click(function (e) {
            e.preventDefault();
            var $target = $(this).parent().parent().next('.panel-body');
            if ($target.is(':visible')) $('i', $(this)).removeClass('fa fa-chevron-circle-up').addClass('fa fa-chevron-circle-down');
            else $('i', $(this)).removeClass('fa-chevron-circle-down').addClass('fa fa-chevron-circle-up');
            $target.slideToggle();
        });
        $('.btn-question').click(function (e) {
            e.preventDefault();
            $('#myModal').modal('show');
        });

        if ($('#megamenuCarousel').length) {
            $('#megamenuCarousel').carousel();
        }




        // ========================================================================
        //	JQuery FitVids Init (js\vendors\fitvids)
        // ========================================================================

        if ($('.vidz').length) {
            $(".vidz").fitVids();
        }


        // ========================================================================
        //	Tree View
        // ========================================================================

        $(function treeview() {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus-circle').removeClass('fa-minus-circle');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus-circle').removeClass('fa-plus-circle');
                }
                e.stopPropagation();
            });
        });


        // ========================================================================
        //	Nestable Lists Init (js\vendors\nestable-lists)
        // ========================================================================

        if ($('#nestable').length) {
            $('#nestable').nestable({
                group: 1
            });
        }

        if ($('#nestable2').length) {
            $('#nestable2').nestable({
                group: 1
            });
        }

        if ($('#nestable-menu').length) {
            $('#nestable-menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
        }

        if ($('#nestable3').length) {
            $('#nestable3').nestable();
        }
        if ($('#nestable4').length) {
            $('#nestable4').nestable();
        }


        // ========================================================================
        //	JQuery KnobInput Init (js\vendors\knob)
        // ========================================================================

        if ($('.knob').length) {
            $(".knob").knob({
                height: '130'
            });
        }
        if ($('.knob2').length) {
            $(".knob2").knob({
                height: '130',
                font: 'Open Sans, sans-serif'
            });
        }
        if ($('.knob3').length) {
            $(".knob3").knob({
                height: '130',
                font: 'Open Sans, sans-serif'
            });
        }
        if ($('.knob4').length) {
            $(".knob4").knob({
                height: '130',
                font: 'Open Sans, sans-serif'
            });
        }
        if ($('.knob5').length) {
            $(".knob5").knob({
                height: '130',
                font: 'Open Sans, sans-serif'
            });
        }
        if ($('.knob6').length) {
            $(".knob6").knob({
                height: '130',
                font: 'Open Sans, sans-serif'
            });
        }


        // ========================================================================
        //	JQuery UI Sliders
        // ========================================================================


        //Base Slider

        if ($('#ui-slider1').length) {
            $('#ui-slider1').slider({
                min: 0,
                max: 500,
                slide: function (event, ui) {
                    $('#ui-slider1-value').text(ui.value);
                }
            });
        }


        // Range slider

        if ($('#ui-slider2').length) {

            $('#ui-slider2').slider({
                min: 0,
                max: 500,
                range: true,
                values: [75, 300],
                slide: function (event, ui) {
                    $('#ui-slider2-value1').text(ui.values[0]);
                    $('#ui-slider2-value2').text(ui.values[1]);
                }
            });
        }

        // Step slider

        if ($('#ui-slider3').length) {
            $('#ui-slider3').slider({
                min: 0,
                max: 500,
                step: 100,
                slide: function (event, ui) {
                    $('#ui-slider3-value').text(ui.value);
                }
            });
        }




        // ========================================================================
        //	Vector Maps (js\vendors\vector-map)
        // ========================================================================

        if ($('#vmap').length) {

            $('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: '#fff',
                color: '#5bc0de',
                borderColor: '#5bc0de',
                hoverOpacity: 0.7,
                selectedColor: '#82b964',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#5bc0de', '#006491'],
                normalizeFunction: 'polynomial'
            });

        }

        if ($('#vmap-usa').length) {
            $('#vmap-usa').vectorMap({
                map: 'usa_en',
                backgroundColor: '#5bc0de',
                color: '#fff',
                hoverOpacity: 0,
                hoverColor: '#f4cc13',
                selectedColor: '#ccd600',
                enableZoom: true,
                showTooltip: true,
                selectedRegion: 'MO'
            });
        }


        if ($('#vmap-europe').length) {
            $('#vmap-europe').vectorMap({
                map: 'europe_en',
                backgroundColor: '#c4c5c5',
                hoverColor: '#f87aa0',
                selectedColor: '#5bc0de',
                enableZoom: true,
                showTooltip: true
            });
        }

        if ($('#vmap-russia').length) {
            $('#vmap-russia').vectorMap({
                map: 'russia_en',
                backgroundColor: '#f1f1f1',
                color: '#d24d33',
                hoverOpacity: 0.7,
                selectedColor: '#999999',
                enableZoom: true,
                borderColor: '#d24d33',
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#f0ad4e', '#d24d33'],
                normalizeFunction: 'polynomial'
            });
        }


        // ========================================================================
        //	Ion Range Sliders (js\vendors\ionrangeslider)
        // ========================================================================

        if ($('#ionrange_1').length) {
            $("#ionrange_1").ionRangeSlider({
                min: 0,
                max: 5000,
                from: 1000,
                to: 4000,
                type: 'double',
                step: 1,
                prefix: "$ ",
                prettify: true,
                hasGrid: true
            });
        }

        if ($('#ionrange_2').length) {
            $("#ionrange_2").ionRangeSlider({
                min: 1000,
                max: 100000,
                from: 30000,
                to: 90000,
                type: 'double',
                step: 500,
                postfix: " €",
                hasGrid: true
            });
        }


        if ($('#ionrange_3').length) {
            $("#ionrange_3").ionRangeSlider({
                min: 0,
                max: 10,
                type: 'single',
                step: 0.1,
                postfix: " carats",
                prettify: false,
                hasGrid: true
            });
        }


        if ($('#ionrange_4').length) {
            $("#ionrange_4").ionRangeSlider({
                min: -50,
                max: 50,
                from: 0,
                postfix: "°",
                prettify: false,
                hasGrid: true
            });
        }

        if ($('#ionrange_5').length) {
            $("#ionrange_5").ionRangeSlider({
                values: [
                    "Jan", "Fef", "Mar",
                    "Apr", "May", "Jan",
                    "Jul", "Aug", "Sep",
                    "Oct", "Nov", "Dec"
                ],
                type: 'single',
                hasGrid: true
            });
        }

        if ($('#ionrange_6').length) {
            $("#ionrange_6").ionRangeSlider({
                min: 10000,
                max: 100000,
                step: 1000,
                postfix: " miles",
                from: 55000,
                hideMinMax: false,
                hideFromTo: true
            });
        }

        if ($('#ionrange_7').length) {
            $("#ionrange_7").ionRangeSlider({
                min: 10000,
                max: 100000,
                step: 100,
                postfix: " kilometres",
                from: 55000,
                hideMinMax: true,
                hideFromTo: false
            });
        }


        // ========================================================================
        //	Powerwidgets (js\vendors\powerwidgets)
        // ========================================================================

        if ($('#powerwidgets').length) {
            $('#powerwidgets').powerWidgets({
                grid: '.bootstrap-grid',
                widgets: '.powerwidget',

                localStorage: true,
                deleteSettingsKey: '#deletesettingskey-options',
                settingsKeyLabel: 'Reset settings?',
                deletePositionKey: '#deletepositionkey-options',
                positionKeyLabel: 'Reset position?',
                sortable: true,
                buttonsHidden: false,
                toggleButton: true,
                toggleClass: 'fa fa-chevron-circle-up | fa fa-chevron-circle-down',
                toggleSpeed: 200,
                onToggle: function () {},
                deleteButton: true,
                deleteClass: 'fa fa-times-circle',
                onDelete: function (widget) {
                    $('#delete-widget').modal(); // shows the modal
                    $(widget).addClass('deletethiswidget'); // ads an indicator class which we will use to find the widget
                },
                editButton: true,
                editPlaceholder: '.powerwidget-editbox',
                editClass: 'fa fa-cog | fa fa-cog',
                editSpeed: 200,
                onEdit: function () {},
                fullscreenButton: true,
                fullscreenClass: 'fa fa-arrows-alt | fa fa-arrows-alt',
                fullscreenDiff: 3,
                onFullscreen: function () {},
                buttonOrder: '%refresh% %delete% %edit% %fullscreen% %toggle%',
                opacity: 1.0,
                dragHandle: '> header',
                placeholderClass: 'powerwidget-placeholder',
                indicator: true,
                indicatorTime: 600,
                ajax: true,
                timestampPlaceholder: '.powerwidget-timestamp',
                timestampFormat: 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
                refreshButton: true,
                refreshButtonClass: 'fa fa-refresh',
                labelError: 'Sorry but there was a error:',
                labelUpdated: 'Last Update:',
                labelRefresh: 'Refresh',
                labelDelete: 'Delete widget:',
                afterLoad: function () {},
                rtl: false,
                onChange: function () {},
                onSave: function () {}
            });
        }

        // Custom way to delete widgets.
        $('#trigger-deletewidget').click(function (e) {
            $('.deletethiswidget').remove(); // delete widget
            $('#delete-widget').modal('hide'); // close the modal
        });
        $('#trigger-deletewidget-reset').click(function (e) {
            $('body').find('.deletethiswidget').removeClass('deletethiswidget'); // cancel so remove indicator class
        });


        // Empty all local storage. (demo not needed)
        $('.empty-local-storage').click(function (e) {
            var $m = $('#confirm_replacer');
            if ($m.length && typeof $.fn.modal === 'function') {
                $('#bootconfirm_confirm', $m).off(clickEvent).on(clickEvent, function (e) {
                    localStorage.clear();
                    location.reload();
                    $m.modal().hide();
                });
                $('.modal-title', $m).text("Clear all localStorage");
                $m.modal();
            } else {
                var cls = confirm("Clear all localStorage?");
                if (cls && localStorage) {
                    localStorage.clear();
                    location.reload();
                }
            }
            e.preventDefault();
        });


        // ========================================================================
        //	Morris Charts (js\vendors\morris)
        // ========================================================================

        if (document.getElementById('morris-area')) {
            Morris.Area({
                element: 'morris-area',
                data: [{
                        period: '2012 Q1',
                        iphone: 2666,
                        ipad: 6000,
                        ipadmini: 2647,
                        itouch: 2647,
                        imac: 2647
                    }, {
                        period: '2012 Q2',
                        iphone: 2778,
                        ipad: 2294,
                        ipadmini: 1333,
                        itouch: 2441,
                        imac: 200
                    }, {
                        period: '2012 Q3',
                        iphone: 4912,
                        ipad: 1969,
                        ipadmini: 1267,
                        itouch: 2501,
                        imac: 4234
                    }, {
                        period: '2012 Q4',
                        iphone: 3767,
                        ipad: 3597,
                        ipadmini: 2001,
                        itouch: 5689,
                        imac: 7585
                    }, {
                        period: '2013 Q1',
                        iphone: 6810,
                        ipad: 1914,
                        ipadmini: 6421,
                        itouch: 2293,
                        imac: 1290
                    }, {
                        period: '2013 Q2',
                        iphone: 5670,
                        ipad: 4293,
                        ipadmini: 5692,
                        itouch: 6881,
                        imac: 3987
                    }, {
                        period: '2013 Q3',
                        iphone: 4820,
                        ipad: 3795,
                        ipadmini: 2647,
                        itouch: 1588,
                        imac: 5690
                    }, {
                        period: '2013 Q4',
                        iphone: 15073,
                        ipad: 5967,
                        ipadmini: 2100,
                        itouch: 5175,
                        imac: 6890
                    }, {
                        period: '2014 Q1',
                        iphone: 10687,
                        ipad: 4460,
                        ipadmini: 1902,
                        itouch: 2028,
                        imac: 4523
                    }, {
                        period: '2014 Q2',
                        iphone: 8432,
                        ipad: 5713,
                        ipadmini: 2647,
                        itouch: 1791,
                        imac: 907
                    }

                ],
                fillOpacity: '0.8',
                lineWidth: '6',
                gridTextSize: 11,
                pointStrokeWidth: '3',
                gridTextFamily: 'Open Sans, sans-serif',
                lineColors: ["#82b964", "#858689", "#993838", "#f87aa0", "f4b66d"],
                xkey: 'period',
                ykeys: ['iphone', 'ipad', 'ipadmini', 'itouch', 'imac'],
                labels: ['iPhone', 'iPad', 'iPad Mini', 'iPod Touch', 'IMac'],
            }).on('click', function (i, row) {
                console.log(i, row);
            });

        }

        if (document.getElementById('morris-area-lines')) {
            Morris.Area({
                element: 'morris-area-lines',
                behaveLikeLine: true,
                data: [{
                        period: '2012 Q1',
                        iphone: 2666,
                        ipad: 6000,
                        ipadmini: 2647,
                    }, {
                        period: '2012 Q2',
                        iphone: 2778,
                        ipad: 2294,
                        ipadmini: 1333,
                    }, {
                        period: '2012 Q3',
                        iphone: 4912,
                        ipad: 1969,
                        ipadmini: 1267,
                    }, {
                        period: '2012 Q4',
                        iphone: 3767,
                        ipad: 3597,
                        ipadmini: 2001,
                    }, {
                        period: '2013 Q1',
                        iphone: 6810,
                        ipad: 1914,
                        ipadmini: 6421,
                    }, {
                        period: '2013 Q2',
                        iphone: 5670,
                        ipad: 4293,
                        ipadmini: 5692,
                    }, {
                        period: '2013 Q3',
                        iphone: 4820,
                        ipad: 3795,
                        ipadmini: 2647,
                    }, {
                        period: '2013 Q4',
                        iphone: 15073,
                        ipad: 5967,
                        ipadmini: 2100,
                    }, {
                        period: '2014 Q1',
                        iphone: 10687,
                        ipad: 4460,
                        ipadmini: 1902,
                    }, {
                        period: '2014 Q2',
                        iphone: 8432,
                        ipad: 5713,
                        ipadmini: 2647,
                    }

                ],
                lineWidth: '6',
                pointStrokeWidth: '3',
                gridTextFamily: 'Open Sans, sans-serif',
                lineColors: ["#82b964", "#8960a7", "#993838", "#f87aa0", "f4b66d"],
                xkey: 'period',
                gridTextSize: 11,
                ykeys: ['iphone', 'ipad', 'ipadmini'],
                labels: ['iPhone', 'iPad', 'iPad Mini']
            });

        }

        if (document.getElementById('morris-line')) {

            var week_data = [{
                "period": "2011 W27",
                "licensed": 3407,
                "sorned": 660,
                "leaked": 123
            }, {
                "period": "2011 W26",
                "licensed": 3351,
                "sorned": 629,
                "leaked": 2660
            }, {
                "period": "2011 W25",
                "licensed": 3269,
                "sorned": 618,
                "leaked": 1660
            }, {
                "period": "2011 W24",
                "licensed": 3246,
                "sorned": 661,
                "leaked": 3456
            }, {
                "period": "2011 W23",
                "licensed": 3257,
                "sorned": 667,
                "leaked": 873
            }, {
                "period": "2011 W22",
                "licensed": 3248,
                "sorned": 627,
                "leaked": 660
            }, {
                "period": "2011 W21",
                "licensed": 3171,
                "sorned": 660,
                "leaked": 839
            }, {
                "period": "2011 W20",
                "licensed": 3171,
                "sorned": 676,
                "leaked": 2999
            }, {
                "period": "2011 W19",
                "licensed": 666,
                "sorned": 656,
                "leaked": 660
            }, {
                "period": "2011 W18",
                "licensed": 3215,
                "sorned": 622,
                "leaked": 2650
            }, {
                "period": "2011 W17",
                "licensed": 3148,
                "sorned": 632,
                "leaked": 1890
            }, {
                "period": "2011 W16",
                "licensed": 3155,
                "sorned": 300,
                "leaked": 660
            }, {
                "period": "2011 W15",
                "licensed": 491,
                "sorned": 667,
                "leaked": 660

            }, {
                "period": "2011 W14",
                "licensed": 3226,
                "sorned": 620,
                "leaked": 781
            }, {
                "period": "2011 W13",
                "licensed": 3245,
                "sorned": 200,
                "leaked": 660
            }, {
                "period": "2011 W12",
                "licensed": 999,
                "sorned": 300,
                "leaked": 660
            }, {
                "period": "2011 W11",
                "licensed": 3263,
                "sorned": null,
                "leaked": 660
            }, {
                "period": "2011 W10",
                "licensed": 1250,
                "sorned": 3987,
                "leaked": 660
            }, {
                "period": "2011 W09",
                "licensed": 121,
                "sorned": 555,
                "leaked": 660
            }, {

                "period": "2011 W08",
                "licensed": 3085,
                "sorned": 234,
                "leaked": 532
            }, {
                "period": "2011 W07",
                "licensed": 3055,
                "sorned": 342,
                "leaked": 789
            }, {
                "period": "2011 W06",
                "licensed": 590,
                "sorned": 546,

                "leaked": 334
            }, {
                "period": "2011 W05",
                "licensed": 2943,
                "sorned": 2573,
                "leaked": 454
            }, {
                "period": "2011 W04",
                "licensed": 2806,
                "sorned": 489,
                "leaked": 2343
            }, {
                "period": "2011 W03",
                "licensed": 953,
                "sorned": 490,
                "leaked": 345
            }, {
                "period": "2011 W02",
                "licensed": 1702,
                "sorned": 23,
                "leaked": 660
            }, {
                "period": "2011 W01",
                "licensed": 1732,
                "sorned": 2342,
                "leaked": 660
            }];

            Morris.Line({
                element: 'morris-line',
                lineWidth: '6',
                gridTextColor: '#fff',
                pointStrokeWidth: '3',
                gridTextFamily: 'Open Sans, sans-serif',
                lineColors: ["#f4cc13", "#5bc0de", "#993838", "#ccd600", "f4b66d"],
                data: week_data,
                xkey: 'period',
                gridTextSize: 11,
                ykeys: ['licensed', 'sorned', 'leaked'],
                labels: ['Licensed', 'SORN', 'Pirates']
            });

        }

        if (document.getElementById('morris-stacked')) {
            Morris.Bar({
                element: 'morris-stacked',
                data: [{
                    x: '2013 Q1',
                    y: 3,
                    z: 2,
                    a: 3,
                    b: 6
                }, {
                    x: '2013 Q2',
                    y: 2,
                    z: null,
                    a: 1,
                    b: 3
                }, {
                    x: '2013 Q3',
                    y: 0,
                    z: 2,
                    a: 4,
                    b: 2
                }, {
                    x: '2013 Q4',
                    y: 2,
                    z: 4,
                    a: 3,
                    b: 1
                }],
                gridTextFamily: 'Open Sans, sans-serif',
                barColors: ["#82b964", "#858689", "#993838", "#f87aa0", "f4b66d"],
                xkey: 'x',
                gridTextSize: 11,
                ykeys: ['y', 'z', 'a', 'b'],
                labels: ['Y', 'Z', 'A', 'B'],
                stacked: true

            });
        }

        // ========================================================================
        //	FlotChart (js\vendors\flotchart)
        // ========================================================================

        //Example #1 - Chart With Graph Controls
        var d1 = [];
        var i;
        var plot;
        for (i = 0; i <= 10; i += 1) {
            d1.push([i, parseInt(Math.random() * 30)]);
        }

        var d2 = [];
        for (i = 0; i <= 10; i += 1) {
            d2.push([i, parseInt(Math.random() * 30)]);
        }

        var d3 = [];
        for (i = 0; i <= 10; i += 1) {
            d3.push([i, parseInt(Math.random() * 30)]);
        }

        var stack, bars, lines, steps;

        stack = 0;
        bars = false;
        lines = true;
        steps = false;



        function plotWithOptions() {


            if ($("#placeholder").length) {
                $.plot("#placeholder", [d1, d2, d3], {
                    colors: ["#5bc0de", "#82b964", "#f4cc13"],

                    grid: {
                        hoverable: true,
                        clickable: false,
                        borderWidth: 0,
                        backgroundColor: "transparent"
                    },

                    yaxis: {
                        font: {
                            color: '#555',
                            family: 'Open Sans, sans-serif',
                            size: 11
                        },
                        tickColor: "transparent"
                    },
                    xaxis: {
                        font: {
                            color: '#555',
                            family: 'Open Sans, sans-serif',
                            size: 11
                        },
                        tickColor: "rgba(0,0,0,0.1)"
                    },

                    series: {
                        lines: {
                            show: lines,
                            lineWidth: 0,
                            color: '#fff',
                            fill: 1,
                            steps: steps
                        },

                        bars: {
                            show: bars,
                            barWidth: 0.5,
                            fill: 1,
                            lineWidth: 0
                        }
                    }
                });
            }
        }
        plotWithOptions();

        $(".btn-group button").click(function (e) {
            e.preventDefault();
            bars = $(this).text().indexOf("Bars") != -1;
            lines = $(this).text().indexOf("Lines") != -1;
            steps = $(this).text().indexOf("steps") != -1;
            plotWithOptions();
        });


        //Example #2 - Stacked Graph

        if ($("#placeholder2").length) {

            var dates2 = [
                ["Jan", 56],
                ["Feb", 67],
                ["Mar", 42],
                ["Apr", 87],
                ["May", 53],
                ["June", 38],
                ["July", 49],
                ["Aug", 32],
                ["Sep", 33],
                ["Oct", 34],
                ["Nov", 41],
                ["Dec", 14]
            ];

            var dates1 = [
                ["Jan", 189],
                ["Feb", 244],
                ["Mar", 293],
                ["Apr", 192],
                ["May", 265],
                ["June", 167],
                ["July", 231],
                ["Aug", 169],
                ["Sep", 163],
                ["Oct", 168],
                ["Nov", 152],
                ["Dec", 52]
            ];


            $.plot("#placeholder2", [{
                data: dates1,
                label: "Earnings"
            }, {
                data: dates2,
                label: "Buys"
            }], {
                colors: ["#5bc0de", "#f87aa0"],
                grid: {
                    hoverable: true,
                    clickable: false,
                    borderWidth: 0,
                    backgroundColor: "transparent"
                },
                legend: {

                    labelBoxBorderColor: false,
                },
                series: {
                    bars: {
                        show: true,
                        barWidth: 0.9,
                        fill: 1,
                        lineWidth: 0,
                        align: "center"
                    }
                },
                xaxis: {
                    font: {
                        color: '#555',
                        family: 'Open Sans, sans-serif',
                        size: 11
                    },
                    mode: "categories",
                    tickLength: 0
                },
                yaxis: {
                    font: {
                        color: '#333',
                        family: 'Open Sans, sans-serif',
                        size: 11
                    }
                }
            });

        }
        //Example #3 - Line Chart With Tooltip
        // helper for returning the weekends in a period

        function weekendAreas(axes) {

            var markings = [],
                d = new Date(axes.xaxis.min);

            // go to the first Saturday

            d.setUTCDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7));
            d.setUTCSeconds(0);
            d.setUTCMinutes(0);
            d.setUTCHours(0);

            var i = d.getTime();

            // when we don't set yaxis, the rectangle automatically
            // extends to infinity upwards and downwards

            do {
                markings.push({
                    xaxis: {
                        from: i,
                        to: i + 2 * 24 * 60 * 60 * 1000
                    }
                });
                i += 7 * 24 * 60 * 60 * 1000;
            } while (i < axes.xaxis.max);

            return markings;
        }



        if ($("#placeholder3").length) {

            var d = [
                [1196463600000, 0],
                [1196550000000, 0],
                [1196636400000, 0],
                [1196722800000, 77],
                [1196809200000, 3636],
                [1196895600000, 3575],
                [1196982000000, 2736],
                [1197068400000, 1086],
                [1197154800000, 676],
                [1197241200000, 1205],
                [1197327600000, 906],
                [1197414000000, 710],
                [1197500400000, 639],
                [1197586800000, 540],
                [1197673200000, 435],
                [1197759600000, 301],
                [1197846000000, 575],
                [1197932400000, 481],
                [1198018800000, 591],
                [1198105200000, 608],
                [1198191600000, 459],
                [1198278000000, 234],
                [1198364400000, 1352],
                [1198450800000, 686],
                [1198537200000, 279],
                [1198623600000, 449],
                [1198710000000, 468],
                [1198796400000, 392],
                [1198882800000, 282],
                [1198969200000, 208],
                [1199055600000, 229],
                [1199142000000, 177],
                [1199228400000, 374],
                [1199314800000, 436],
                [1199401200000, 404],
                [1199487600000, 253],
                [1199574000000, 218],
                [1199660400000, 476],
                [1199746800000, 462],
                [1199833200000, 448],
                [1199919600000, 442],
                [1200006000000, 403],
                [1200092400000, 204],
                [1200178800000, 194],
                [1200265200000, 327],
                [1200351600000, 374],
                [1200438000000, 507],
                [1200524400000, 546],
                [1200610800000, 482],
                [1200697200000, 283],
                [1200783600000, 221],
                [1200870000000, 483],
                [1200956400000, 523],
                [1201042800000, 528],
                [1201129200000, 483],
                [1201215600000, 452],
                [1201302000000, 270],
                [1201388400000, 1222],
                [1201474800000, 1439],
                [1201561200000, 2559],
                [1201647600000, 2521],
                [1201734000000, 2477],
                [1201820400000, 442],
                [1201906800000, 252],
                [1201993200000, 236],
                [1202079600000, 525],
                [1202166000000, 477],
                [1202252400000, 386],
                [1202338800000, 409],
                [1202425200000, 408],
                [1202511600000, 237],
                [1202598000000, 193],
                [1202684400000, 357],
                [1202770800000, 414],
                [1202857200000, 393],
                [1202943600000, 353],
                [1203030000000, 364],
                [1203116400000, 215],
                [1203202800000, 214],
                [1203289200000, 356],
                [1203375600000, 1399],
                [1203462000000, 334],
                [1203548400000, 348],
                [1203634800000, 243],
                [1203721200000, 126],
                [1203807600000, 157],
                [1203894000000, 288]
            ];

            // first correct the timestamps - they are recorded as the daily
            // midnights in UTC+0100, but Flot always displays dates in UTC
            // so we have to add one hour to hit the midnights in the plot

            for (i = 0; i < d.length; ++i) {
                d[i][0] += 60 * 60 * 1000;
            }



            var options3 = {

                grid: {
                    hoverable: true,
                    markingsColor: "rgba(0,0,0,0.1)",
                    clickable: true,
                    autoHighlight: true,
                    borderWidth: 0,
                    backgroundColor: "transparent",
                    markings: weekendAreas
                },

                xaxis: {
                    mode: "time",
                    tickLength: 5,
                    font: {
                        color: '#555',
                        family: 'Open Sans, sans-serif',
                        size: 11
                    },
                },

                yaxis: {
                    font: {
                        color: '#555',
                        family: 'Open Sans, sans-serif',
                        size: 11
                    },
                    tickColor: "rgba(0,0,0,0.1)"
                },

                points: {
                    radius: 3,
                    show: true,
                    symbol: "circle"
                },

                shadowSize: 0,


                lines: {
                    show: true,
                    fill: true,
                    lineWidth: 7,
                },
                colors: ["#8960a7"],

                tooltip: true,
                tooltipOpts: {
                    content: "$%y.2",
                    shifts: {
                        x: -10,
                        y: 25
                    }
                }

            };
            plot = $.plot("#placeholder3", [d], options3);
        }



        //Example #4 - Very Slow Live Bar Example - 10 stacks of data!

        var data = [],
            series;

        function getRandomData() {

            if (data.length) {
                data = data.slice(1);
            }

            while (data.length < maximum) {
                var previous = data.length ? data[data.length - 1] : 70;
                var y = previous + Math.random() * 10 - 5;
                data.push(y < 0 ? 0 : y > 100 ? 100 : y);
            }

            // zip the generated y values with the x values

            var res = [];
            for (var i = 1; i < data.length; ++i) {
                res.push([i, data[i]]);
            }

            return res;
        }


        if ($("#placeholder4").length) {
            var container4 = $("#placeholder4");

            // Determine how many data points to keep based on the placeholder's initial size;
            // this gives us a nice high-res plot while avoiding more than one point per pixel.

            var maximum = 11; // container.outerWidth() / 2 || 300;
            data = [];
            var series4;




            //

            series4 = [{
                data: getRandomData(),

                bars: {
                    show: true,
                    fill: 1,
                    barWidth: 0.8,
                    align: 'center',
                    horizontal: false
                }


            }];

            //

            var plot4 = $.plot(container4, series4, {

                colors: ["#fff"],

                axisLabelUseCanvas: false,

                grid: {
                    borderWidth: 0,
                    color: '#fff',
                    backgroundColor: '#6a6f76',
                    hoverable: true,

                    mouseActiveRadius: 50,



                    markings: function (axes) {
                        var markings = [];
                        var xaxis = axes.xaxis;

                        for (var x = Math.floor(xaxis.min); x < xaxis.max; x += xaxis.tickSize * 2) {
                            markings.push({
                                xaxis: {
                                    from: x,
                                    to: x + xaxis.tickSize
                                },
                                color: "#6a6f76"
                            });
                        }
                        return markings;
                    }
                },
                xaxis: {
                    color: '#797e83',
                    font: {
                        color: '#fff',
                        family: 'Open Sans, sans-serif',
                        size: 11
                    },

                    //  min: 0,
                    // max: 10,
                    tickDecimals: 0

                },

                yaxis: {
                    color: '#797e83',
                    font: {
                        color: '#fff',
                        family: 'Open Sans, sans-serif',
                        size: 11
                    },
                    min: 0,
                    max: 110
                },

                tooltip: true,
                tooltipOpts: {
                    content: "Core #%x | Loaded %y.2%"
                }
            });

            setInterval(function updateRandom() {

                series4[0].data = getRandomData();
                plot4.setData(series4);
                plot4.draw();
            }, 1000);
        }

        //Example #5 Donut
        //We init function to use it in AJAX Widgets Reload

        window.initFloatchartDemo = function () {
            series = Math.floor(Math.random() * 6) + 3;

            for (i = 0; i < series; i++) {
                data[i] = {
                    label: "Series" + (i + 1),
                    data: Math.floor(Math.random() * 100) + 1
                };
            }


            $.plot('#placeholder5', data, {


                colors: ["#333", "#f87aa0", "#5bc0de", "#82b964", "#ccd600", "#f4cc13", "#8960a7", "#454b52", "#d24d33", "#f0ad4e"],

                series: {
                    pie: {
                        show: true,
                        innerRadius: 0.4,
                        stroke: {
                            width: 0
                        }
                    }

                },
                grid: {
                    hoverable: true,
                    clickable: true
                }

            });
        };
        if ($("#placeholder5").length) {
            window.initFloatchartDemo();
        }

        //Example #6 - Pie Chart
        //We init function to use it in AJAX Widgets Reload
        var series6 = Math.floor(Math.random() * 6) + 3;

        window.initFloatchartDemo2 = function () {


            series6 = Math.floor(Math.random() * 6) + 3;
            for (i = 0; i < series6; i++) {
                data[i] = {
                    label: "Series" + (i + 1),
                    data: Math.floor(Math.random() * 100) + 1
                };
            }
            $.plot('#placeholder6', data, {
                colors: ["#333", "#f87aa0", "#5bc0de", "#82b964", "#ccd600", "#f4cc13", "#8960a7", "#454b52", "#d24d33", "#f0ad4e"],
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }

                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                legend: {
                    show: true,
                    backgroundColor: 'rgb(255, 255, 255)',
                    backgroundOpacity: 0.85
                }
            });

        };
        if ($("#placeholder6").length) {
            window.initFloatchartDemo2();
        }

        //Example #7 - Live Chart


        function getRandomData7() {
            var res = [];
            if (data.length > 0)
                data = data.slice(1);

            // Do a random walk

            while (data.length < totalPoints) {
                var previous = data.length ? data[data.length - 1] : 50;
                var y = previous + Math.random() * 10 - 5;
                data.push(y < 0 ? 0 : y > 100 ? 100 : y);
            }
            // Zip the generated y values with the x values


            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }

            return res;
        }

        function getRandomData72() {
            var res = [];
            if (data.length > 0)
                data = data.slice(1);

            // Do a random walk

            while (data.length < totalPoints) {
                var previous = data.length ? data[data.length - 1] : 50;
                var y = previous + Math.random() * 10 - 5;
                data.push(y < 0 ? 0 : y > 100 ? 100 : y);
            }
            // Zip the generated y values with the x values


            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i] / 2]);
            }

            return res;
        }


        if ($("#placeholder7").length) {

            data = [];
            var totalPoints = 50;
            var updateInterval = 200;
            var container7 = $("#placeholder7");

            // initialize a plot with to series of data
            var plot7 = $.plot(container7, [getRandomData7(), getRandomData72()], {


                grid: {
                    borderWidth: 0,
                    hoverable: true,
                    clickable: false,
                    markingsColor: "rgba(255,255,255,0.1)",
                    backgroundColor: "transparent",

                    markings: function (axes) {
                        var markings = [];
                        var xaxis = axes.xaxis;
                        for (var x = Math.floor(xaxis.min); x < xaxis.max; x += xaxis.tickSize * 2) {
                            markings.push({
                                xaxis: {
                                    from: x,
                                    to: x + xaxis.tickSize
                                },
                                color: "#000"
                            });
                        }
                        return markings;
                    }

                },

                series: {

						points: {
                        radius: 3,
                        show: true,
                        fillColor: '#fff',
                        symbol: "circle"
                    },

                    lines: {
                        show: true,
                        fill: true,
                        fillColor: '#00a9ae',
                        lineWidth: 7,
                    },
					
                    tickFormatter: function () {
                        return "";
                    },
					
                    shadowSize: 0 // Drawing is faster without shadows
                },
                yaxis: {
                    font: {
                        color: '#fff',
                        family: 'Open Sans, sans-serif',
                        size: 11
                    },
                    min: 0,
                    max: 110
                },
                xaxis: {
                    show: false
                },
                colors: ["#5bc0de", "#f4cc13"],



            });


            // flot controls logic -------------------------------------------------------------------------------------

            /** variable to hold plot's updating interval identifier */
            var timer;

            /** plot's current speed */
            var speed = 0;

            /** flag to indicate flot state */
            var isRunning = false;

            /** a handler of click event on start-stop button */
            $('#start-stop-flot').off('click').on('click', function () {
                var $this = $(this);
                if ($this.is('.active')) {
                    $this.text('Start');
                    flotController.stopFlot(timer);
                } else {
                    $this.text('Pause');
                    timer = flotController.startFlot(plot7);
                }
                $this.toggleClass('active');
            });

            /** a handler of click event on accelerate button */
            $('#accelerate-flot').off('click').on('click', function () {

                // increment speed...
                speed++;

                // ... but take care about it to be not more than flotController.speeds - maximum available value
                speed %= flotController.speeds;

                $(this).text('Update Rate: ' + (speed + 1));

                // restart flot with new speed if it is running
                if (isRunning) {
                    flotController.stopFlot(timer);
                    timer = flotController.startFlot(plot7);
                }
            });

            /** this is an object to encapsulate flot controlling logic and data */
            var flotController = {

                /** number of speeds available */
                speeds: 4,

                /** method to start flot */
                startFlot: function (chart) {
                    isRunning = true;
                    return setInterval(function update7() {
                        chart.setData([getRandomData7(), getRandomData72()]);
                        chart.draw();

                        // specify update interval depending on current speed
                    }, (updateInterval / (speed + 1)));
                },

                /** method to stop flot */
                stopFlot: function (timer) {
                    if (timer) {
                        clearInterval(timer);
                        isRunning = false;
                    }
                }
            };

            // start flot
            timer = flotController.startFlot(plot7);

            // ---------------------------------------------------------------------------------------------------------

        }



        //Example #8
        //Facebook and Twitter on Index//

        if ($("#placeholder8").length) {

            var facebook = [
                [1, 4302],
                [2, 3516],
                [3, 4925],
                [4, 3134],
                [5, 4545],
                [6, 5434],
                [7, 5241],
                [8, 6211],
                [9, 5900],
                [10, 6601],
                [11, 4822],
                [12, 4233]
            ];
            var twitter = [
                [1, 1802],
                [2, 2344],
                [3, 1543],
                [4, 2016],
                [5, 1900],
                [6, 3511],
                [7, 4144],
                [8, 4655],
                [9, 3442],
                [10, 3445],
                [11, 3132],
                [12, 2598]
            ];

            var pinterest = [
                [1, 1102],
                [2, 2144],
                [3, 1243],
                [4, 2316],
                [5, 1500],
                [6, 2511],
                [7, 4744],
                [8, 4255],
                [9, 1442],
                [10, 2445],
                [11, 2932],
                [12, 1598]
            ];


            var dribble = [
                [1, 102],
                [2, 244],
                [3, 143],
                [4, 216],
                [5, 100],
                [6, 211],
                [7, 444],
                [8, 455],
                [9, 142],
                [10, 245],
                [11, 232],
                [12, 198]
            ];

            var googleplus = [
                [1, 3302],
                [2, 2516],
                [3, 3925],
                [4, 3134],
                [5, 3545],
                [6, 4434],
                [7, 3241],
                [8, 5211],
                [9, 4900],
                [10, 4601],
                [11, 2822],
                [12, 1233]
            ];

            var vkontakte = [
                [1, 2202],
                [2, 2716],
                [3, 3325],
                [4, 2834],
                [5, 2945],
                [6, 1434],
                [7, 3541],
                [8, 1211],
                [9, 4920],
                [10, 3601],
                [11, 1822],
                [12, 4233]
            ];


            $.plot($("#placeholder8"), [{
                    data: facebook,
                    label: "Facebook"
                }, {
                    data: twitter,
                    label: "Twitter"
                }, {
                    data: pinterest,
                    label: "Pinterest"
                },

                {
                    data: dribble,
                    label: "Dribble"
                },

                {
                    data: googleplus,
                    label: "Google Plus"
                },

                {
                    data: vkontakte,
                    label: "VK"
                },




            ], {
                series: {
                    lines: {
                        show: true,
                        lineWidth: 7,
                        fill: true,
                        fillColor: "rgba(255,255,255, 0.2)"
                    },

                    points: {
                        show: true,
                        fillColor: "#fff",
                        lineWidth: 3,
                        radius: 5
                    },
                    shadowSize: 0,
                    stack: true
                },


                tooltip: true,
                tooltipOpts: {
                    content: "%y Refs"
                },

                grid: {
                    hoverable: true,
                    clickable: true,

                    borderWidth: 0
                },

                legend: {
                    noColumns: 3,
                    margin: -10,
                    color: '#555',
                    backgroundColor: '#fff',
                    backgroundOpacity: 1,
                    position: "nw"
                },


                colors: ["#47639e", "#55acee", "#cb2027", "#333", "#a0c3ff", "#597da3"],
                xaxis: {
                    color: "rgba(0,0,0,.1)",
                    ticks: [
                        [1, "JAN"],
                        [2, "FEB"],
                        [3, "MAR"],
                        [4, "APR"],
                        [5, "MAY"],
                        [6, "JUN"],
                        [7, "JUL"],
                        [8, "AUG"],
                        [9, "SEP"],
                        [10, "OCT"],
                        [11, "NOV"],
                        [12, "DEC"]
                    ],
                    font: {
                        color: "#8b8f94",
                        size: 11,
                        family: "Open Sans, sans-serif",
                    }
                },
                yaxis: {
                    color: "rgba(255,255,255,0.4)",
                    ticks: 5,
                    show: false,
                    tickDecimals: 0,
                    font: {
                        color: "#fff",
                        size: 11,
                    }
                }
            });
        }


        if ($("#placeholder9").length) {
            $(function () {

                var datasets = {




                    "uk": {
                        label: "UK",
                        data: [
                            [2000, 62982],
                            [2001, 62027],
                            [2002, 60696],
                            [2003, 62348],
                            [2004, 58560],
                            [2005, 56393],
                            [2006, 54579],
                            [2007, 50818],
                            [2008, 50554],
                            [2009, 48276],
                            [2010, 57691],
                            [2011, 47529],
                            [2012, 47778],
                            [2013, 48760],
                            [2014, 49474]
                        ]
                    },
                    "japan": {
                        label: "Japan",
                        data: [
                            [2000, 55627],
                            [2001, 55475],
                            [2002, 58464],
                            [2003, 55134],
                            [2004, 52436],
                            [2005, 47139],
                            [2006, 43962],
                            [2007, 43238],
                            [2008, 42395],
                            [2009, 40854],
                            [2010, 40993],
                            [2011, 41822],
                            [2012, 41147],
                            [2013, 40474],
                            [2014, 36474]
                        ]
                    },
                    "usa": {
                        label: "USA",
                        data: [
                            [2000, 48399],
                            [2001, 47906],
                            [2002, 45764],
                            [2003, 40194],
                            [2004, 42470],
                            [2005, 40237],
                            [2006, 37786],
                            [2007, 35738],
                            [2008, 33794],
                            [2009, 33618],
                            [2010, 32861],
                            [2011, 32942],
                            [2012, 34217],
                            [2013, 34493],
                            [2014, 32493]
                        ]
                    },

                    "russia": {
                        label: "Russia",
                        data: [
                            [2000, 21800],
                            [2001, 20300],
                            [2002, 17100],
                            [2004, 42500],
                            [2005, 37600],
                            [2006, 36600],
                            [2007, 21700],
                            [2008, 19200],
                            [2009, 21300],
                            [2010, 13600],
                            [2011, 17000],
                            [2012, 19100],
                            [2013, 21300],
                            [2014, 23600]
                        ]
                    },
                    "china": {
                        label: "China",
                        data: [
                            [2000, 4813],
                            [2001, 16719],
                            [2002, 3722],
                            [2003, 13789],
                            [2004, 13720],
                            [2005, 15730],
                            [2006, 8636],
                            [2007, 3598],
                            [2008, 3610],
                            [2009, 6655],
                            [2010, 3695],
                            [2011, 11673],
                            [2012, 3553],
                            [2013, 3774],
                            [2014, 3728]
                        ]
                    },

                    "others": {
                        label: "Others",
                        data: [
                            [2000, 2813],
                            [2001, 7719],
                            [2002, 2722],
                            [2003, 2789],
                            [2004, 11720],
                            [2005, 13730],
                            [2006, 2636],
                            [2007, 1598],
                            [2008, 2610],
                            [2009, 1655],
                            [2010, 1695],
                            [2011, 6673],
                            [2012, 1553],
                            [2013, 2774],
                            [2014, 1728]
                        ]
                    },
                };

                // hard-code color indices to prevent them from shifting as
                // countries are turned on/off

                var zx = 0;
                $.each(datasets, function (key, val) {
                    val.color = zx;
                    ++zx;
                });

                // insert checkboxes 
                var choiceContainer = $("#choices");



                choiceContainer.find("input").click(plotAccordingToChoices);

                function plotAccordingToChoices() {

                    var data = [];

                    choiceContainer.find("input:checked").each(function () {
                        var key = $(this).attr("name");
                        if (key && datasets[key]) {
                            data.push(datasets[key]);
                        }
                    });

                    if (data.length > 0) {
                        $.plot("#placeholder9", data, {



                            series: {
                                lines: {
                                    show: true,
                                    lineWidth: 7,
                                    fill: true,
                                    fillColor: {
                                        colors: [{
                                            opacity: 1
                                        }, {
                                            opacity: 1
                                        }]
                                    }
                                },

                                points: {
                                    show: true,
                                    fillColor: "#595f66",
                                    lineWidth: 3,
                                    radius: 5
                                },
                                shadowSize: 0,
                                stack: true
                            },

                            colors: ["#33383d", "#454b52", "#5bc0de", "#82b964", "#ccd600", "#f4cc13", "#8960a7", "#454b52", "#d24d33", "#f0ad4e"],

                            grid: {
                                hoverable: true,
                                clickable: true,
                                color: '#555',
                                borderWidth: 0
                            },

                            legend: {

                                noColumns: 3,
                                margin: -15,
                                backgroundColor: '#fff',
                                backgroundOpacity: 1,
                            },

                            yaxis: {
                                show: false,
                                min: 0,
                                font: {
                                    color: "#ddd",
                                    size: 11,
                                    family: "Open Sans, sans-serif",
                                }
                            },
                            xaxis: {

                                tickDecimals: 0,
                                font: {
                                    color: "#ddd",
                                    size: 11,
                                    family: "Open Sans, sans-serif",
                                }
                            },
                            tooltip: true,
                            tooltipOpts: {
                                content: "$%y.2",
                                shifts: {
                                    x: -10,
                                    y: 25
                                }
                            }

                        });
                    }
                }

                plotAccordingToChoices();


            });

        }




        // ========================================================================
        //	FullCalendar (js\vendors\fullcalendar)
        // ========================================================================

        //Calendar with Draggable Events
        // initialize the external events
        if ($('#external-events div.external-event').length) {
            $('#external-events div.external-event').each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });

            // initialize the calendar
            var date = new Date();
            var dd = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today,title',
                    right: 'month,agendaWeek,agendaDay'
                },

                events: [{
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    className: ["event", "greenEvent"]

                }, {
                    title: 'Long Event',
                    start: new Date(y, m, dd - 5),
                    end: new Date(y, m, dd - 2),
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, dd - 3, 16, 0),
                    allDay: false
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, dd + 4, 16, 0),
                    allDay: false
                }, {
                    title: 'Meeting',
                    start: new Date(y, m, dd, 10, 30),
                    allDay: false
                }, {
                    title: 'Lunch',
                    start: new Date(y, m, dd, 12, 0),
                    end: new Date(y, m, dd, 14, 0),
                    allDay: false
                }, {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/',
                    className: [".greenEvent"]

                }],

                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                }
            });
        }


        // initialize the calendar on index page
        var date2 = new Date();
        var ddd = date2.getDate();
        var mmm = date2.getMonth();
        var yyy = date2.getFullYear();


        if ($('#calendar2').length) {
            $('#calendar2').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                events: [{
                    title: 'All Day Event',
                    start: new Date(yyy, mmm, 1)
                }, {
                    title: 'Long Event',
                    start: new Date(yyy, mmm, ddd - 5),
                    end: new Date(yyy, mmm, ddd - 2)
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(yyy, mmm, ddd - 3, 16, 0),
                    allDay: false
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(yyy, mmm, ddd + 4, 16, 0),
                    allDay: false
                }, {
                    title: 'Meeting',
                    start: new Date(yyy, mmm, ddd, 10, 30),
                    allDay: false
                }, {
                    title: 'Lunch',
                    start: new Date(yyy, mmm, ddd, 12, 0),
                    end: new Date(yyy, mmm, ddd, 14, 0),
                    allDay: false
                }, {
                    title: 'Birthday Party',
                    start: new Date(yyy, mmm, ddd + 1, 19, 0),
                    end: new Date(yyy, mmm, ddd + 1, 22, 30),
                    allDay: false
                }, {
                    title: 'Click for Google',
                    start: new Date(yyy, mmm, 28),
                    end: new Date(yyy, mmm, 29),
                    url: 'http://google.com/'
                }]
            });
        }


        // ========================================================================
        //	Bootstrap Tooltips and Popovers
        // ========================================================================

        if ($('.tooltiped').length) {
            $('.tooltiped').tooltip();
        }

        if ($('.popovered').length) {
            $('.popovered').popover({
                'html': 'true'
            });
        }


        // Making Bootstrap Popover Hovered


        if ($('.popover-hovered').length) {
            $('.popover-hovered').popover({
                trigger: 'hover',
                'html': 'true',
                'placement': 'top'
            });
        }

        // ========================================================================
        //	Progress Bars
        // ========================================================================

        if ($('.v-default-animated .progress-bar').length) {
            $('.v-default-animated .progress-bar').progressbar();
        }

        if ($('.h-default-basic .progress-bar').length) {
            $('.h-default-basic .progress-bar').progressbar({
                display_text: 'fill',
                use_percentage: false
            });
        }
        if ($('.v-bottom-animated .progress-bar').length) {
            $('.v-bottom-animated .progress-bar').progressbar({
                display_text: 'fill'
            });
        }

        // ========================================================================
        //	Full screen Toggle
        // ========================================================================

        $('#toggle-fullscreen').click(function () {
            screenfull.request();
        });


        // ========================================================================
        //	Keep open Bootstrap Dropdown on click
        // ========================================================================

        $('.keep_open').click(function (event) {
            event.stopPropagation();
        });


        // ========================================================================
        //	Nanoscroller
        // ========================================================================

        if ($('.nano').length) {
            $(".nano").nanoScroller();
        }


        // ========================================================================
        //	Inbox Page
        // ========================================================================

        function inbox() {

            // check all checkboxes in table
            $('.checkall').click(function () {

                var $parentTable = $(this).parents('table');
                var $checkboxes = $parentTable.find('.checkbox');
                var isChecked = $(this).is(':checked');


                $checkboxes.prop('checked', isChecked).parent().toggleClass('checked', isChecked);
                $parentTable.find('tbody tr').toggleClass('selected', isChecked);

            });

            // star
            $('.mailinbox .fa-flag').click(function () {
                var isStarred = $(this).is('.flagged-yellow');
                $(this).toggleClass('flagged-yellow', !isStarred).toggleClass('flagged-grey', isStarred);
            });

            //add class selected to table row when checked
            $('.mailinbox tbody input:checkbox').click(function () {
                $(this).parents('tr').toggleClass('selected', $(this).prop('checked'));
            });

            // trash
            $('.delete').click(function (e) {
                e.preventDefault();

                var $checked = $('.mailinbox .checkbox:checked');
                var toDelete = $checked.length;

                if (toDelete === 0) {
                    showAlert('No selected message');
                    return;
                }

                $checked.parents('tr').remove();

                var msg = $checked.length > 1 ? 'messages' : 'message';
                var info = $checked.length + ' ' + msg + ' deleted';
                showAlert(info);
            });

            // mark as read/unread
            $('.mark_read, .mark_unread').click(function (e) {
                e.preventDefault();

                var $checked = $('.mailinbox .checkbox:checked');
                var toMark = $checked.length;

                if (toMark === 0) {
                    showAlert('No selected message');
                    return;
                }

                $checked.parents('tr').toggleClass('unread', !$(this).is('.mark_read'));

                var msg = $checked.length > 1 ? 'messages were' : 'message was';
                var state = $(this).is('.mark_read') ? ' read' : ' unread';
                var info = $checked.length + ' ' + msg + ' marked as ' + state;
                showAlert(info);
            });

            // Refresh stub
            $('.refresh').click(function (e) {
                e.preventDefault();
                showLoader();
            });

            // bootstrap alert div
            var $alertDiv = $('<div class="alert alert-danger alert-inbox">')
                .css({
                    display: 'none',
                    position: 'absolute',
                    top: '40%'
                })
                .appendTo('.table-relative');

            // show alert
            function showAlert(message) {
                var w = $alertDiv.text(message).width();
                $alertDiv.show();
                var left = ($alertDiv.parent().width() - w) / 2;
                $alertDiv.css('left', left);
                setTimeout(function () {
                    $alertDiv.fadeOut();
                }, 1000);
            }

            // ajax loader div
            var $loader = $('<div class="loader-darkener">').appendTo('.table-relative');
            $('<div class="fa-spin dummy-loader">').appendTo($loader);

            // show ajax loader
            function showLoader() {
                $loader.show();
                setTimeout(function () {
                    $loader.hide();
                }, 1000);
            }
        }



        // ========================================================================
        //	Sparklines (js\vendors\sparkline)
        // ========================================================================


        //Sparklines at Horisontal Menu//
        $('.inlinebar2').sparkline('html', {
            type: 'bar',
            barWidth: '10px',
            height: '40px',
            enableTagOptions: 'true',
            barColor: '#de5546'
        });

        $('.inlinebar').sparkline('html', {
            type: 'bar',
            barWidth: '7px',
            height: '40px',
            enableTagOptions: 'true',
            barColor: '#969fa1'
        });

        $('.stackedbar').sparkline('html', {
            type: 'bar',
            barWidth: '7px',
            height: '40px',
            enableTagOptions: 'true',
            stackedBarColor: ['#fff', '#c4c5c5'],
        });

        $('.piechart').sparkline('html', {
            type: 'pie',
            width: '40',
            height: '40',
            sliceColors: ['#fff', '#82b964', '#f87aa0', '#109618', '#a4b7bf', '#506066', '#667880', '#8ca0a8']
        });

        $('.linechart').sparkline('html', {
            type: 'line',
            width: '100',
            height: '40',
            lineColor: '#fff',
            fillColor: '#81c1d9',
            lineWidth: 3,
            spotColor: '#ffffff',
            minSpotColor: '#33383d',
            maxSpotColor: '#33383d',
            highlightSpotColor: '#a6c172',
            spotRadius: 3,
            drawNormalOnTop: false
        });


        $('.simpleline').sparkline('html', {
            type: 'line',
            width: '100',
            height: '40',
            lineColor: '#82b964',
            fillColor: false,
            lineWidth: 3,
            spotColor: '#ffffff',
            minSpotColor: '#52646c',
            maxSpotColor: '#fff',
            highlightSpotColor: '#a6c172',
            spotRadius: 3,
            drawNormalOnTop: false
        });


        //Sparklines at Tables //
        $('.table-sparkline-pie').sparkline('html', {
            type: 'pie',
            width: '30',
            height: '30',
            sliceColors: ['#f4b66d', '#993838', '#fff', '#82b964', '#66aa00', '#dd4477', '#0099c6', '#990099 ']
        });

        $('.table-sparkline-pie2').sparkline('html', {
            type: 'pie',
            width: '30',
            height: '30',
            sliceColors: ['#5bc0de', '#f0ad4e', '#f87aa0', '#58b868', '#454b52', '#dd4477', '#0099c6', '#990099 ']
        });


        $(".table-sparkline-lines").sparkline('html', {
            type: 'line',
            lineColor: '#858689',
            width: '100',
            height: '30',
            fillColor: '#8b8c8d',
            lineWidth: 3,
            spotRadius: 3,
            spotColor: '#f4b66d',
            minSpotColor: '#fff',
            maxSpotColor: '#fff',
            highlightSpotColor: '#a6c172'
        });


        //Sparklines at Search //			
        $('.piechart-search').sparkline('html', {
            type: 'pie',
            width: '60',
            height: '60',
            sliceColors: ['#f87aa0', '#5bc0de', '#82b964', '#f4cc13', '#454b52', '#d24d33', '#f0ad4e']
        });



        //Sparklines at Portlet

        $('#portlet-compositeline').sparkline('html', {
            fillColor: 'rgba(167,96,154,.5)',
            spotRadius: '3',
            width: '310',
            height: '100',
            lineColor: '#a7609a',
            highlightSpotColor: '#a7609a',
            spotColor: '#a7609a',
            minSpotColor: '#a7609a',
            maxSpotColor: '#a7609a',
            lineWidth: 4,
            highlightLineColor: '#a7609a',
            changeRangeMin: 0,
            chartRangeMax: 10
        });

        $('#portlet-compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 2, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7], {
            composite: true,
            fillColor: 'rgba(91,192,222,.7)',
            spotRadius: '3',
            lineColor: 'rgba(91,192,222,,1)',
            highlightSpotColor: '#5bc0de',

            spotColor: '#5bc0de',
            minSpotColor: '#5bc0de',
            maxSpotColor: '#5bc0de',
            lineWidth: 4,
            highlightLineColor: 'rgba(255,255,255,.2)',
            changeRangeMin: 0,
            chartRangeMax: 10
        });


        // Bar + line composite charts
        $('#portlet-compositebar').sparkline('html', {
            type: 'bar',
            barWidth: '20',
            barSpacing: '5',
            width: '310',
            height: '100',
            barColor: '#5bc0de',
        });
        $('#portlet-compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7], {
            composite: true,
            fillColor: false,
            spotRadius: '3',
            width: '310',
            height: '100',
            lineColor: '#a7609a',
            highlightSpotColor: '#a7609a',
            spotColor: '#a7609a',
            minSpotColor: '#a7609a',
            maxSpotColor: '#a7609a',
            lineWidth: 4,
            highlightLineColor: '#a7609a',
            changeRangeMin: 0,
            chartRangeMax: 10
        });


        //Sparklines Demo on other charts page

        $('.demo-sparkline').sparkline('html', {
            fillColor: false,
            lineColor: '#858689',
            spotColor: '#f4b66d'
        });

        // Bar charts using inline values
        $('.demo-sparkbar').sparkline('html', {
            type: 'bar',
            barColor: '#5bc0de',
            negBarColor: '#d24d33',
            stackedBarColor: ['#5bc0de', '#d24d33']
        });

        // Composite line charts, the second using values supplied via javascript
        $('#demo-compositeline').sparkline('html', {
            fillColor: false,
            lineColor: '#858689',
            spotColor: '#f4b66d',
            changeRangeMin: 0,
            chartRangeMax: 10
        });

        $('#demo-compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7], {
            composite: true,
            fillColor: false,
            lineColor: '#d24d33',
            changeRangeMin: 0,
            chartRangeMax: 10
        });

        // Line charts with normal range marker
        $('#demo-normalline').sparkline('html', {
            fillColor: false,
            normalRangeMin: -1,
            normalRangeMax: 8
        });
        $('#demo-normalExample').sparkline('html', {
            fillColor: false,
            normalRangeMin: 80,
            normalRangeMax: 95,
            normalRangeColor: '#5bc0de'
        });


        // Bar + line composite charts
        $('#demo-compositebar').sparkline('html', {
            type: 'bar',
            barColor: '#5bc0de',
        });
        $('#demo-compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7], {
            composite: true,
            fillColor: false,
            lineColor: '#f87aa0'
        });

        // Discrete charts
        $('.demo-discrete1').sparkline('html', {
            type: 'discrete',
            lineColor: '#58b868',
            xwidth: 18
        });
        $('#demo-discrete2').sparkline('html', {
            type: 'discrete',
            lineColor: '#58b868',
            thresholdColor: '#d24d33',
            thresholdValue: 4
        });


        // Tri-state charts using inline values
        $('.demo-sparktristatecols').sparkline('html', {
            type: 'tristate',
            colorMap: {
                '-2': '#5bc0de',
                '2': '#d24d33'
            },
            posBarColor: '#5bc0de',
            negBarColor: '#d24d33'
        });


        // Box plots
        $('.demo-sparkboxplot').sparkline('html', {
            type: 'box',
            boxLineColor: '#222',
            boxFillColor: '#c4c5c5',
            whiskerColor: '#222',
            outlierLineColor: '#222',
            medianColor: '#333',
            outlierFillColor: '#888'
        });


        // Box plot with specific field order
        $('.demo-boxfieldorder').sparkline('html', {
            type: 'box',
            boxLineColor: '#222',
            boxFillColor: '#c4c5c5',
            whiskerColor: '#222',
            outlierLineColor: '#222',
            medianColor: '#333',
            outlierFillColor: '#888',
            tooltipFormatFieldlist: ['med', 'lq', 'uq'],
            tooltipFormatFieldlistKey: 'field'
        });

        // Bullet charts
        $('.demo-sparkbullet').sparkline('html', {
            type: 'bullet',
            targetColor: '#d24d33',
            performanceColor: '#969fa1',
            rangeColors: ['#f4cc13', '#8960a7', '#5bc0de', '#82b964']
        });

        // Pie charts
        $('.demo-sparkpie').sparkline('html', {
            type: 'pie',
            height: '14px',
            sliceColors: ['#f87aa0', '#5bc0de', '#82b964']
        });


        // ========================================================================
        //	Left Responsive Menu
        // ========================================================================	  

        $(document).ready(function () {

            // Responsive Menu//
            $(".responsive-menu").click(function () {
                $(".responsive-admin-menu #menu").slideToggle();
            });
            $(window).resize(function () {
                $(".responsive-admin-menu #menu").removeAttr("style");
            });

            (function multiLevelAccordion($root) {

                var $accordions = $('.accordion', $root).add($root);
                $accordions.each(function () {

                    var $this = $(this);
                    var $active = $('> li > a.submenu.active', $this);
                    $active.next('ul').css('display', 'block');
                    $active.addClass('downarrow');
                    var a = $active.attr('data-id') || '';

                    var $links = $this.children('li').children('a.submenu');
                    $links.click(function (e) {
                        if (a !== "") {
                            $("#" + a).prev("a").removeClass("downarrow");
                            $("#" + a).slideUp("fast");
                        }
                        if (a == $(this).attr("data-id")) {
                            $("#" + $(this).attr("data-id")).slideUp("fast");
                            $(this).removeClass("downarrow");
                            a = "";
                        } else {
                            $("#" + $(this).attr("data-id")).slideDown("fast");
                            a = $(this).attr("data-id");
                            $(this).addClass("downarrow");
                        }
                        e.preventDefault();
                    });
                });
            })($('#menu'));




            // Responsive Menu Adding Opened Class//

            $(".responsive-admin-menu #menu li").hover(
                function () {
                    $(this).addClass("opened").siblings("li").removeClass("opened");
                },
                function () {
                    $(this).removeClass("opened");
                }
            );



            // ========================================================================
            //	Datatables
            // ========================================================================

            //Basic Table
            if ($('#table-1').length) {
                $('#table-1').dataTable();
            }



            //Table With Column Clearing


            var asInitVals = [];

            if ($('#table-3').length) {
                $('#table-3').dataTable({
                    "bPaginate": false,
                    "sDom": 'C<"clear">lfrtip',
                    colVis: {
                        order: 'alfa'
                    }
                });
            }
            //Table With Column Filtering


            if ($('#table-2').length) {
                var oTable = $('#table-2').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    }
                });

                $("tfoot input").keyup(function () {
                    /* Filter on the column (the index) of this element */
                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                });


                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });

                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });

                $("tfoot input").blur(function (i) {
                    if (this.value === "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            }


            // if there's google maps script on the page
            if (typeof google !== 'undefined') {

                // ========================================================================
                //	Google Maps
                // ========================================================================

                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions

                var mapOptions = {

                    map_canvas: {

                        // How zoomed in you want the map to start at (always required)
                        zoom: 11,

                        // disable default UI
                        controls: false,

                        // The latitude and longitude to center the map (always required)
                        latitude: 40.6700, // New York,
                        longitude: -73.9400,



                        // How you would like to style the map. 
                        styles: [{
                            'featureType': 'water',
                            'stylers': [{
                                'visibility': 'on'
                            }, {
                                'color': '#638897'
                            }]
                        }, {
                            'featureType': 'landscape',
                            'stylers': [{
                                'color': '#f2e5d4'
                            }]
                        }, {
                            'featureType': 'road.highway',
                            'elementType': 'geometry',
                            'stylers': [{
                                'color': '#82b964'
                            }]
                        }, {
                            'featureType': 'road.arterial',
                            'elementType': 'geometry',
                            'stylers': [{
                                'color': '#e4d7c6'
                            }]
                        }, {
                            'featureType': 'road.local',
                            'elementType': 'geometry',
                            'stylers': [{
                                'color': '#fbfaf7'
                            }]
                        }, {
                            'featureType': 'poi.park',
                            'elementType': 'geometry',
                            'stylers': [{
                                'color': '#82b964'
                            }]
                        }, {
                            'featureType': 'administrative',
                            'stylers': [{
                                'visibility': 'on'
                            }, {
                                'lightness': 33
                            }]
                        }, {
                            'featureType': 'road'
                        }, {
                            'featureType': 'poi.park',
                            'elementType': 'labels',
                            'stylers': [{
                                'visibility': 'on'
                            }, {
                                'lightness': 20
                            }]
                        }, {}, {
                            'featureType': 'road',
                            'stylers': [{
                                'lightness': 20
                            }]
                        }]
                    },

                    map_canvas2: {
                        zoom: 11,

                        // disable default UI
                        controls: false,

                        latitude: 40.6700, // New York,
                        longitude: -73.9400,

                        styles: [{
                            "stylers": [{
                                "saturation": -100
                            }, {
                                "gamma": 1
                            }]
                        }, {
                            "elementType": "labels.text.stroke",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.business",
                            "elementType": "labels.text",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.business",
                            "elementType": "labels.icon",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.place_of_worship",
                            "elementType": "labels.text",
                            "stylers": [{

                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.place_of_worship",
                            "elementType": "labels.icon",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [{
                                "visibility": "simplified"
                            }]
                        }, {
                            "featureType": "water",
                            "stylers": [{
                                "visibility": "on"
                            }, {
                                "saturation": 50
                            }, {
                                "gamma": 0
                            }, {
                                "hue": "#50a5d1"
                            }]
                        }, {
                            "featureType": "administrative.neighborhood",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                "color": "#333333"
                            }]
                        }, {
                            "featureType": "road.local",
                            "elementType": "labels.text",
                            "stylers": [{
                                "weight": 0.5
                            }, {
                                "color": "#333333"
                            }]
                        }, {
                            "featureType": "transit.station",
                            "elementType": "labels.icon",
                            "stylers": [{
                                "gamma": 1
                            }, {
                                "saturation": 10
                            }]
                        }]
                    },

                    map_canvas3: {
                        zoom: 11,

                        // disable default UI
                        controls: false,

                        latitude: 40.6700, // New York,
                        longitude: -73.9400,

                        styles: [{
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#81c1d9"
                            }]
                        }, {
                            "featureType": "landscape",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#f0f0ed"
                            }]
                        }, {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#c4c5c5"
                            }]
                        }, {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#e2e8e7"
                            }]
                        }, {
                            "featureType": "transit",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#e2e8e7"
                            }]
                        }, {
                            "elementType": "labels.text.stroke",
                            "stylers": [{
                                "visibility": "on"
                            }, {
                                "color": "#81c1d9"
                            }, {
                                "weight": 6
                            }]
                        }, {
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                "color": "#ffffff"
                            }]
                        }, {
                            "featureType": "administrative",
                            "elementType": "geometry",
                            "stylers": [{
                                "weight": 0.2
                            }, {
                                "color": "#1a3541"
                            }]
                        }, {
                            "elementType": "labels.icon",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#e2e8e7"
                            }]
                        }]
                    },

                    // settings for map in mega menu
                    googlemaps1: {

                        // allow map controls
                        controls: {
                            panControl: true,
                            zoomControl: true,
                            mapTypeControl: true,
                            scaleControl: true,
                            streetViewControl: false,
                            overviewMapControl: true
                        },

                        // disable scroll wheel
                        scrollwheel: false,

                        // setup custom marker
                        markers: [{

                            latitude: 40.6700,
                            longitude: -73.9400,


                            html: "<strong>ORB Head Office</strong><br>Boulevard of Broken Dreams 66, Apt 99<br>",
                            icon: {
                                image: "images/pin.png",
                                iconsize: [35, 55],
                                iconanchor: [35, 55]
                            }
                        }],


                        styles: [{
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#a2daf2"
                            }]
                        }, {
                            "featureType": "landscape.man_made",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#f7f1df"
                            }]
                        }, {
                            "featureType": "landscape.natural",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#d0e3b4"
                            }]
                        }, {
                            "featureType": "landscape.natural.terrain",
                            "elementType": "geometry",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#bde6ab"
                            }]
                        }, {
                            "featureType": "poi",
                            "elementType": "labels",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.medical",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#fbd3da"
                            }]
                        }, {
                            "featureType": "poi.business",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "road",
                            "elementType": "geometry.stroke",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "road",
                            "elementType": "labels",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "road.highway",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "#ffe15f"
                            }]
                        }, {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [{
                                "color": "#efd151"
                            }]
                        }, {
                            "featureType": "road.arterial",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "#ffffff"
                            }]
                        }, {
                            "featureType": "road.local",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "black"
                            }]
                        }, {
                            "featureType": "transit.station.airport",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "#cfb2db"
                            }]
                        }],


                        // initial coordinates
                        latitude: 40.6700,
                        longitude: -73.9400,

                        zoom: 10
                    }
                };

                // sometimes we want to resize map after it's container has been resized,
                // so we can specify an element and event to trigger map resize
                var resizeEvents = {
                    googlemaps1: {
                        target: '.dropdown',
                        evt: 'show.bs.dropdown'
                    }
                };

                // setup maps
                $('.map-container').each(function () {

                    // for each map on the page, take it's options by id
                    var mapSettings = mapOptions[this.id];

                    // create map
                    var $map = $(this).gMap(mapSettings);

                    // store the reference to 'native' google map object
                    var map = $map.data('gMap.reference');

                    // apply styling if any
                    var styles = mapSettings['styles'];
                    if (styles) {
                        map.setOptions({
                            styles: styles
                        });
                    }

                    // do subscribe on events to resize after
                    var evts;
                    if (evts = resizeEvents[this.id] || resizeEvents['*']) {
                        $(evts.target).on(evts.evt, function () {
                            var center = map.getCenter();
                            setTimeout(function () {
                                google.maps.event.trigger($map[0], 'resize');
                                map.setCenter(center);
                            }, 10);
                        });
                    }
                });

            }
        });


        // ========================================================================
        //	Forms
        // ========================================================================

        //Masking

        if ($('#date, #date2').length) {
            $("#date, #date2").mask('99/99/9999', {
                placeholder: 'X'
            });
        }

        if ($('#phone').length) {
            $("#phone").mask('(999) 999-9999', {
                placeholder: 'X'
            });
        }

        if ($('#card').length) {
            $("#card").mask('9999-9999-9999-9999', {
                placeholder: 'X'
            });
        }

        if ($('#serial').length) {
            $("#serial").mask('***-***-***-***-***-***', {
                placeholder: '_'
            });
        }
        if ($('#tax').length) {
            $("#tax").mask('99-9999999', {
                placeholder: 'X'
            });
        }
        if ($('#cvv').length) {
            $('#cvv').mask('999', {
                placeholder: 'X'
            });
        }
        if ($('#year').length) {
            $('#year').mask('2099', {
                placeholder: 'X'
            });
        }


        //Datepicker

        // Regular datepicker
        if ($('#date').length) {
            $('#date').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
            });
        }

        // Date range
        if ($('#start').length) {
            $('#start').datepicker({
                dateFormat: 'dd/mm/yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#finish').datepicker('option', 'minDate', selectedDate);
                }
            });
        }
        if ($('#finish').length) {
            $('#finish').datepicker({
                dateFormat: 'dd/mm/yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#start').datepicker('option', 'maxDate', selectedDate);
                }
            });
        }

        // Inline datepicker
        if ($('#inline').length) {
            $('#inline').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
            });
        }

        // Inline date range
        if ($('#inline-start').length) {
            $('#inline-start').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#inline-finish').datepicker('option', 'minDate', selectedDate);
                }
            });
        }
        if ($('#inline-finish').length) {
            $('#inline-finish').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#inline-start').datepicker('option', 'maxDate', selectedDate);
                }
            });
        }




        // Validation Examples




        // Available Validations
        if ($('#available-validations').length) {

            $("#available-validations").validate({
                // Rules for form validation
                rules: {
                    required: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    date3: {
                        required: true,
                        date: true
                    },
                    min: {
                        required: true,
                        minlength: 5
                    },
                    max: {
                        required: true,
                        maxlength: 5
                    },
                    range: {
                        required: true,
                        rangelength: [5, 10]
                    },
                    digits: {
                        required: true,
                        digits: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    minVal: {
                        required: true,
                        min: 5
                    },
                    maxVal: {
                        required: true,
                        max: 100
                    },
                    rangeVal: {
                        required: true,
                        range: [5, 100]
                    }
                },

                // Messages for form validation
                messages: {
                    required: {
                        required: 'Please enter something'
                    },
                    email: {
                        required: 'Please enter your email address'
                    },
                    url: {
                        required: 'Please enter your URL'
                    },
                    date3: {
                        required: 'Please enter some date in mm/dd/yyyy format'
                    },
                    min: {
                        required: 'Please enter some text'
                    },
                    max: {
                        required: 'Please enter some text'
                    },
                    range: {
                        required: 'Please enter some text'
                    },
                    digits: {
                        required: 'Please enter some digits'
                    },
                    number: {
                        required: 'Please enter some number'
                    },
                    minVal: {
                        required: 'Please enter some value'
                    },
                    maxVal: {
                        required: 'Please enter some value'
                    },
                    rangeVal: {
                        required: 'Please enter some value'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }




        // Login Form Validation
        if ($('#login-form').length) {
            $("#login-form").validate({
                // Rules for form validation
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    }
                },

                // Messages for form validation
                messages: {
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    password: {
                        required: 'Please enter your password'
                    }
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });

        }

        // Checkout Form Validation


        if ($('#checkout-form').length) {
            $('#checkout-form').validate({

                // Rules for form validation
                rules: {
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    code: {
                        required: true,
                        digits: true
                    },
                    address: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    card: {
                        required: true
                    },
                    cvv: {
                        required: true,
                        digits: true
                    },
                    month: {
                        required: true
                    },
                    year: {
                        required: true,
                        digits: true
                    }
                },

                // Messages for form validation
                messages: {
                    fname: {
                        required: 'Please enter your first name'
                    },
                    lname: {
                        required: 'Please enter your last name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    country: {
                        required: 'Please select your country'
                    },
                    city: {
                        required: 'Please enter your city'
                    },
                    code: {
                        required: 'Please enter code',
                        digits: 'Digits only please'
                    },
                    address: {
                        required: 'Please enter your full address'
                    },
                    name: {
                        required: 'Please enter name on your card'
                    },
                    card: {
                        required: 'Please enter your card number'
                    },
                    cvv: {
                        required: 'Enter CVV2',
                        digits: 'Digits only'
                    },
                    month: {
                        required: 'Select month'
                    },
                    year: {
                        required: 'Enter year',
                        digits: 'Digits only please'
                    }
                },


                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

        //Order Form Validation
        if ($('#order-form').length) {
            $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    interested: {
                        required: true
                    },
                    budget: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    interested: {
                        required: 'Please select interested service'
                    },
                    budget: {
                        required: 'Please select your budget'
                    }
                },

                // Ajax form submition
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        beforeSend: function () {
                            $('#order-form button[type="submit"]').addClass('button-uploading').attr('disabled', true);
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $("#order-form .progress").text(percentComplete + '%');
                        },
                        success: function () {
                            $("#order-form").addClass('submited');
                            $('#order-form button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
                        }
                    });
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }


        //Registration Form Validation
        if ($('#registration-form').length) {
            $("#registration-form").validate({
                // Rules for form validation
                rules: {
                    username: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: true,
                        minlength: 3,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    terms: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    login: {
                        required: 'Please enter your login'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    password: {
                        required: 'Please enter your password'
                    },
                    passwordConfirm: {
                        required: 'Please enter your password one more time',
                        equalTo: 'Please enter the same password as above'
                    },
                    firstname: {
                        required: 'Please select your first name'
                    },
                    lastname: {
                        required: 'Please select your last name'
                    },
                    gender: {
                        required: 'Please select your gender'
                    },
                    terms: {
                        required: 'You must agree with Terms and Conditions'
                    }
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

        //Review Form Validation
        if ($('#review-form').length) {
            $("#review-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },

                    email: {
                        required: true,
                        email: true
                    },
                    review: {
                        required: true,
                        minlength: 20
                    },
                    quality: {
                        required: true
                    },
                    reliability: {
                        required: true
                    },
                    overall: {
                        required: true

                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    review: {
                        required: 'Please enter your review'
                    },
                    quality: {
                        required: 'Please rate quality of the product'
                    },
                    reliability: {

                        required: 'Please rate reliability of the product'
                    },
                    overall: {
                        required: 'Please rate the product'
                    }
                },

                // Ajax form submition					
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        beforeSend: function () {
                            $('#review-form button[type="submit"]').attr('disabled', true);
                        },
                        success: function () {
                            $("#review-form").addClass('submited');
                        }
                    });
                },


                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

        //Steps Validation			

        if ($('#wizard').length) {
            $('#wizard').steps({
                bodyTag: 'fieldset',
                autoFocus: true,
                transitionEffect: 'slideLeft',
                finish: 'Continue',
                onStepChanging: function (e, i, j) {
                    $("#steps-wizard").validate().settings.ignore = ":disabled,:hidden";
                    return $("#steps-wizard").valid();
                },
                onFinishing: function () {
                    $("#steps-wizard").validate().settings.ignore = ":disabled";
                    return $("#steps-wizard").valid();
                },
                onFinished: function () {
                    $("#steps-wizard").submit();
                }
            });
        }



        // Validation
        if ($('#steps-wizard').length) {
            $('#steps-wizard').validate({
                // Rules for form validation
                rules: {
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    code: {
                        required: true,
                        digits: true
                    },
                    address: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    card: {
                        required: true,
                    },
                    cvv: {
                        required: true,
                        digits: true
                    },
                    month: {
                        required: true
                    },
                    year: {
                        required: true,
                        digits: true
                    }
                },

                // Messages for form validation
                messages: {
                    fname: {
                        required: 'Please enter your first name'
                    },
                    lname: {
                        required: 'Please enter your last name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    country: {
                        required: 'Please select your country'
                    },
                    city: {
                        required: 'Please enter your city'
                    },
                    code: {
                        required: 'Please enter code',
                        digits: 'Digits only please'
                    },
                    address: {
                        required: 'Please enter your full address'
                    },
                    name: {
                        required: 'Please enter name on your card'
                    },
                    card: {
                        required: 'Please enter your card number'
                    },
                    cvv: {
                        required: 'Enter CVV2',
                        digits: 'Digits only'
                    },
                    month: {
                        required: 'Select month'
                    },
                    year: {
                        required: 'Enter year',
                        digits: 'Digits only please'
                    }
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

        // ========================================================================
        //	Easy Pie Charts
        // ========================================================================

        //Facebook//
        if ($('#easy1').length) {
            $('#easy1').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#47639e',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

        //Twitter//
        if ($('#easy2').length) {
            $('#easy2').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#55acee',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }
        //Pinterest//
        if ($('#easy3').length) {
            $('#easy3').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#cb2027',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }
        //Dribble//
        if ($('#easy4').length) {
            $('#easy4').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#333',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

        //GooglePlus//
        if ($('#easy5').length) {
            $('#easy5').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#a0c3ff',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

        //VK//
        if ($('#easy6').length) {
            $('#easy6').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#597da3',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));

                }
            });
        }

        if ($('#easy7').length) {
            $('#easy7').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '23',
                trackColor: '#999',
                lineCap: 'butt',
                barColor: '#fff',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

        if ($('#easy8').length) {
            $('#easy8').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '23',
                trackColor: '#cacac8',
                lineCap: 'butt',
                barColor: '#949fb2',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }


        // ========================================================================
        //	Horisontal Menu (js\vendors\horisontal)
        // ========================================================================

        var menu = new cbpHorizontalSlideOutMenu(document.getElementById('cbp-hsmenu-wrapper'));

        // ========================================================================
        //	Summernote (js\vendors\summernote)
        // ========================================================================

        if ($('#summernote').length) {
            $('#summernote').summernote({
                height: 100,
                focus: false
            });

            // ========================================================================
            //	Sign Out Modal
            // ========================================================================            

            $(".goaway").click(function (e) {
                e.preventDefault();
                $('#signout').modal();
                $('#yesigo').click(function () {
                    window.open('admin-login.html', '_self');
                    $('#signout').modal('hide');
                });

            });
        }


        // ========================================================================
        //	Lock Modal
        // ======================================================================== 

        $(".lockme").click(function (e) {
            e.preventDefault();
            $('#lockscreen').modal();
            $('#yesilock').click(function () {
                window.open('admin-lock.html', '_self');
                $('#lockscreen').modal('hide');
            });

        });



        // ========================================================================
        //	User View Switch (Users List Page)
        // ========================================================================
        function init() {
            optionSwitch.forEach(function (el, i) {
                el.addEventListener('click', function (ev) {
                    ev.preventDefault();
                    _switch(this);
                }, false);
            });
        }

        function _switch(opt) {
            // remove other view classes and any any selected option
            optionSwitch.forEach(function (el) {
                classie.remove(container, el.getAttribute('data-view'));
                classie.remove(el, 'items-selected');
            });
            // add the view class for this option
            classie.add(container, opt.getAttribute('data-view'));
            // this option stays selected
            classie.add(opt, 'items-selected');
        }


        if (document.getElementById('items')) {
            var container, optionSwitch;
            container = document.getElementById('items');
            optionSwitch = Array.prototype.slice.call(container.querySelectorAll('div.items-options > a'));
            init();
        }


        // ========================================================================
        //	Inbox
        // ========================================================================

        // check all checkboxes in table
        $('.checkall').click(function () {

            var $parentTable = $(this).parents('table');
            var $checkboxes = $parentTable.find('.checkbox');
            var isChecked = $(this).is(':checked');

            $checkboxes.prop('checked',
                isChecked).parent().toggleClass('checked', isChecked);
            $parentTable.find('tbody tr').toggleClass('selected', isChecked);

        });

        // star
        $('.fa-star').click(function () {
            var isStarred = $(this).is('.star-yellow');
            $(this).toggleClass('star-yellow', !isStarred).toggleClass('star-grey', isStarred);
        });

        //add class selected to table row when checked
        $('.mailinbox tbody input:checkbox').click(function () {
            $(this).parents('tr').toggleClass('selected', $(this).prop('checked'));
        });

        // trash
        $('.delete').click(function (e) {
            e.preventDefault();

            var $checked = $('.mailinbox .checkbox:checked');
            var toDelete = $checked.length;

            if (toDelete === 0) {
                showAlert('No selected message');
                return;
            }

            $checked.parents('tr').remove();

            var msg = $checked.length > 1 ? 'messages' : 'message';
            var info = $checked.length + ' ' + msg + ' deleted';
            showAlert(info);
        });

        // mark as read/unread
        $('.mark_read, .mark_unread').click(function (e) {
            e.preventDefault();

            var $checked = $('.mailinbox .checkbox:checked');
            var toMark = $checked.length;

            if (toMark === 0) {
                showAlert('No selected message');
                return;
            }

            $checked.parents('tr').toggleClass('unread', !$(this).is('.mark_read'));

            var msg = $checked.length > 1 ? 'messages were' : 'message was';
            var state = $(this).is('.mark_read') ? ' read' : ' unread';
            var info = $checked.length + ' ' + msg + ' marked as ' + state;
            showAlert(info);
        });

        // Refresh stub
        $('.refresh').click(function (e) {
            e.preventDefault();
            showLoader();
        });

        // bootstrap alert div
        var $alertDiv = $('<div class="alert alert-danger alert-inbox">')
            .css({
                display: 'none',
                position: 'absolute',
                top: '40%'
            })
            .appendTo('.table-ctn');

        // show alert
        function showAlert(message) {
            var w = $alertDiv.text(message).width();
            $alertDiv.show();
            var left = ($alertDiv.parent().width() - w) / 2;
            $alertDiv.css('left', left);
            setTimeout(function () {
                $alertDiv.fadeOut();
            }, 1000);
        }

        // ajax loader div
        var $loader = $('<div class="loader-cnt">').appendTo('.table-ctn');
        $('<div class="fa fa-refresh fa-spin loader">').appendTo($loader);

        // show ajax loader
        function showLoader() {
            $loader.show();
            setTimeout(function () {
                $loader.hide();
            }, 1000);
        }

        // ========================================================================
        //	ChartJs (js\vendors\chartjs)
        // ========================================================================

        //Donut Demo
        var doughnutData = [{
                value: 30,
                color: "#82b964"
            }, {
                value: 50,
                color: "#58b868"
            }, {
                value: 100,
                color: "#009485"
            }, {
                value: 40,
                color: "#ccd600"
            }, {
                value: 120,
                color: "#f4cc13"
            }

        ];

        var doughnutoptions = {
            segmentShowStroke: false,
            percentageInnerCutout: 40
        };


        //Donut on Index
        var doughnutData2 = [{
                value: 30,
                color: "#595f66"
            }, {
                value: 50,
                color: "#f4cc13"
            }, {
                value: 100,
                color: "#fff"
            }, {
                value: 40,
                color: "#454b52"

            }

        ];

        var doughnutoptions2 = {
            segmentShowStroke: false,
            percentageInnerCutout: 40
        };


        //Donut on Index
        var doughnutData3 = [{
                value: 15,
                color: "#a7609a"
            }, {
                value: 35,
                color: "#d24d33"
            }, {
                value: 10,
                color: "#f87aa0"
            }, {
                value: 40,
                color: "#f0ad4e"
            }

        ];

        var doughnutoptions3 = {
            segmentShowStroke: false,
            percentageInnerCutout: 40
        };


        //Donut on Index
        var doughnutData4 = [{
                value: 40,
                color: "#454b52"
            }, {
                value: 20,
                color: "#fff"
            }, {
                value: 20,
                color: "#5bc0de"
            }, {
                value: 20,
                color: "#993838"
            }

        ];

        var doughnutoptions4 = {
            segmentShowStroke: false,
            percentageInnerCutout: 40
        };


        //LineChart Demo
        var lineChartData = {
            labels: ["", "", "", "", "", "", ""],
            datasets: [{
                    fillColor: "rgba(150,159,161,0.5)",
                    strokeColor: "rgba(150,159,161,1)",
                    pointColor: "rgba(150,159,161,1)",
                    pointStrokeColor: "#fff",
                    data: [65, 59, 90, 81, 56, 55, 40]
                }, {
                    fillColor: "rgba(91,192,222,0.5)",
                    strokeColor: "rgba(91,192,222,1)",
                    pointColor: "rgba(91,192,222,1)",
                    pointStrokeColor: "#fff",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }

            ]
        };




        var lineChartDataoptions = {
            scaleFontFamily: "'Open Sans'",
            scaleFontSize: 11,
        };


        //LineChart Portlet
        var lineChartData2 = {
            labels: ["", "", "", "", "", "", ""],
            datasets: [{
                fillColor: "rgba(244,204,19,0.5)",
                strokeColor: "#f4cc13",
                data: [65, 59, 99, 81, 56, 55, 40]
            }, {
                fillColor: "rgba(91,192,222,0.5)",
                strokeColor: "rgba(91,192,222,1)",
                data: [28, 48, 88, 56, 72, 65, 100]
            }, {
                fillColor: "rgba(255,255,255,0.5)",
                strokeColor: "#fff",
                data: [12, 32, 42, 13, 33, 27, 59]
            }]


        };

        var lineChartDataoptions2 = {
            pointDot: false,
            datasetStrokeWidth: 4,
            scaleShowGridLines: true,
            scaleShowLabels: false,
        };


        //LineChart Portlet
        var lineChartData3 = {
            labels: ["", "", "", "", "", "", ""],
            datasets: [{
                fillColor: "rgba(51,56,61,0.8)",
                strokeColor: "#33383d",
                data: [88, 71, 99, 83, 99, 66, 71]
            }, {
                fillColor: "rgba(153,56,56,0.8)",
                strokeColor: "#993838",
                data: [65, 59, 99, 81, 56, 55, 0]
            }, {
                fillColor: "rgba(210,77,51,0.8)",
                strokeColor: "#d24d33",
                data: [28, 48, 88, 56, 72, 10, 0]
            }, {
                fillColor: "rgba(240,173,78,0.8)",
                strokeColor: "#f0ad4e",
                data: [12, 32, 42, 13, 33, 27, 0]
            }]


        };

        var lineChartDataoptions3 = {
            pointDot: false,
            datasetStrokeWidth: 4,
            scaleShowGridLines: true,
            scaleShowLabels: false,
        };


        //PieChart Demo
        var pieData = [{
                value: 30,
                color: "#f87aa0"
            }, {
                value: 50,
                color: "#a7609a"
            }, {
                value: 20,
                color: "#d24d33"
            }, {
                value: 10,
                color: "#454b52"
            }, {
                value: 20,
                color: "#993838"
            }

        ];

        var pieChartoptions = {
            segmentShowStroke: false

        };

        //BarChart Demo
        var barChartData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],

            datasets: [{
                fillColor: "rgba(150,159,161,0.5)",
                strokeColor: "rgba(150,159,161,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            }, {
                fillColor: "rgba(210,77,51,0.5)",
                strokeColor: "rgba(210,77,51,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }],
        };

        var barChartoptions = {
            scaleFontFamily: "'Open Sans'",
            scaleFontSize: 11,
        };


        //PolarChart Demo
        var chartData = [{
            value: Math.random(),
            color: "#a7609a"
        }, {
            value: Math.random(),
            color: "#d24d33"
        }, {
            value: Math.random(),
            color: "#21323D"
        }, {
            value: Math.random(),
            color: "#9D9B7F"
        }, {
            value: Math.random(),
            color: "#7D4F6D"
        }, {
            value: Math.random(),
            color: "#82b964"
        }];



        var polarChartoptions = {
            scaleFontFamily: "'Open Sans'",
            scaleFontSize: 10,
            scaleBackdropColor: "rgba(0,0,0,0.75)",
            scaleBackdropPaddingY: 4,
            scaleBackdropPaddingX: 4,
            scaleFontColor: "#fff",
            segmentShowStroke: false,

        };



        //RadarChart Demo
        var radarChartData = {
            labels: ["", "", "", "", "", "", ""],
            datasets: [{
                fillColor: "rgba(150,159,161,0.5)",
                strokeColor: "rgba(150,159,161,1)",
                pointColor: "rgba(150,159,161,1)",
                pointStrokeColor: "#fff",
                data: [65, 59, 90, 81, 56, 55, 40]
            }, {
                fillColor: "rgba(88,184,104,0.5)",
                strokeColor: "rgba(88,184,104,1)",
                pointColor: "rgba(88,184,104,1)",
                pointStrokeColor: "#fff",
                data: [28, 48, 40, 19, 96, 27, 100]
            }]

        };




        if ($('#chartjs-doughnut').length > 0) {
            new Chart(document.getElementById("chartjs-doughnut").getContext("2d")).Doughnut(doughnutData, doughnutoptions);
        }
        if ($('#chartjs-doughnut2').length > 0) {
            new Chart(document.getElementById("chartjs-doughnut2").getContext("2d")).Doughnut(doughnutData2, doughnutoptions2);
        }
        if ($('#chartjs-doughnut3').length > 0) {
            new Chart(document.getElementById("chartjs-doughnut3").getContext("2d")).Doughnut(doughnutData3, doughnutoptions3);
        }
        if ($('#chartjs-doughnut4').length > 0) {
            new Chart(document.getElementById("chartjs-doughnut4").getContext("2d")).Doughnut(doughnutData4, doughnutoptions4);
        }

        if ($('#chartjs-line').length > 0) {
            new Chart(document.getElementById("chartjs-line").getContext("2d")).Line(lineChartData, lineChartDataoptions);
        }
        if ($('#chartjs-line-portlet').length > 0) {
            new Chart(document.getElementById("chartjs-line-portlet").getContext("2d")).Line(lineChartData2, lineChartDataoptions2);
        }
        if ($('#chartjs-line-portlet2').length > 0) {
            new Chart(document.getElementById("chartjs-line-portlet2").getContext("2d")).Line(lineChartData3, lineChartDataoptions3);
        }
        if ($('#chartjs-radar').length > 0) {
            new Chart(document.getElementById("chartjs-radar").getContext("2d")).Radar(radarChartData);
        }
        if ($('#chartjs-polarArea').length > 0) {
            new Chart(document.getElementById("chartjs-polarArea").getContext("2d")).PolarArea(chartData, polarChartoptions);
        }
        if ($('#chartjs-bar').length > 0) {
            new Chart(document.getElementById("chartjs-bar").getContext("2d")).Bar(barChartData, barChartoptions);
        }
        if ($('#chartjs-pie').length > 0) {
            new Chart(document.getElementById("chartjs-pie").getContext("2d")).Pie(pieData, pieChartoptions);
        }




    });

    // ========================================================================
    //	MegaMenu Elements
    // ========================================================================

    // The following code is used to initialize widgets inside dropdown menu
    // after they becomes visible
    // Please note that Google Maps Inits JS in you can found in Google Maps Section of this file


    $('.dropdown').on('show.bs.dropdown', function () {
        var $this = $(this);
        setTimeout(function () {

            // carousels
            var $carousel = $('.carousel', $this).carousel();
            $('[data-slide], [data-slide-to]', $carousel).click(function (e) {
                e.preventDefault();
                $(this).trigger('click.bs.carousel.data-api');
            });

            // tabs
            var $tabs = $('#tabs', $this).tab();
            $('[data-toggle="tab"], [data-toggle="pill"]', $tabs).click(function (e) {
                e.preventDefault();
                $(this).trigger('click.bs.tab.data-api');
            });
        }, 10);
    });

    // ========================================================================
    //	Scroll To Top
    // ========================================================================

    $('.smooth-overflow').on('scroll', function () {

        if ($(this).scrollTop() > 100) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }
    });

    $('.scroll-top-wrapper').on('click', scrollToTop);

    function scrollToTop() {
            var verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0;
            var element = $('body');
            var offset = element.offset();
            var offsetTop = offset.top;
            $('.smooth-overflow').animate({
                scrollTop: offsetTop
            }, 400, 'linear');
        }
        //----------------------------------------------------------------------


})(jQuery);