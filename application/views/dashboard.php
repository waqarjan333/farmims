<style>
	.img-thumbnailx {
		height: 70px !important;
	}
</style>
<div class="row">
	<div class="col-md-6">
		<h4><?php echo $this->lang->line('dashboard') ?></h4>
	</div>
</div>
<div class="row">
	<?php if ($this->session->userdata('active_farm')) { ?>
		<div class="col-md-4 col-xl-4">
			<div class="row">
				<div class="col-xl-12" data-aos="zoom-out" data-aos-duration="1000">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?php echo $this->lang->line('livestock_status') ?></h4>
							<div id="pie_chart" class="apex-charts" dir="ltr"></div>
						</div>
					</div>
				</div>

				<div class="col-xl-12" data-aos="zoom-out" data-aos-delay="300" data-aos-duration="1000">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?php echo $this->lang->line('cattle_status') ?></h4>
							<div id="pie_chart_cattle" class="apex-charts" dir="ltr"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-8 col-md-8">
			<div class="row">
				<div class="col-xl-12"  data-aos="zoom-out" data-aos-delay="200" data-aos-duration="1000">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title mb-4"><?php echo $this->lang->line('milk_yield_last_10_days') ?></h4>

							<div id="daily_milk_yeild_routine_wise" class="apex-charts" dir="ltr"></div>
						</div>
					</div>
					<!--end card-->
				</div>
				<div class="col-xl-12 milk_yeild">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?php echo $this->lang->line('milk_yield_this_month') ?></h4>
							<div id="column_chart_datalabel" class="apex-charts" dir="ltr"></div>
						</div>
					</div>
				</div>
			</div>

			<!--end card-->
		</div>
		<div class="col-xl-12 col-md-12">
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title mb-4"><?php echo $this->lang->line('expences_this_month') ?></h4>

							<div id="expense_bar_chart" class="apex-charts" dir="ltr"></div>
						</div>
					</div>
					<!--end card-->
				</div>
			
			</div>

			<!--end card-->
		</div>
	<?php } ?>
</div> <!-- end row -->

<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<script src="assets/js/app.js"></script>
<script>
	<?php if ($this->session->userdata('active_farm')) { ?>
		var chartData = <?php echo $chart_data; ?>;
		var CattlechartData = <?php echo $cattle_chart_data; ?>;
		var animalNames = <?php echo $animal_Names; ?>;
		var animalYeildqty = <?php echo $animal_Yeildqty; ?>;
		var expenseChart = <?php echo $expenseChart;?>;

		var morningYeild = <?php echo $morningYeild; ?>;
		var afternoonYeild = <?php echo $afternoonYeild; ?>;
		var eveningYeild = <?php echo $eveningYeild; ?>;
		var dateYeild = <?php echo $dateYeild; ?>;
		var active = "<?php echo $this->lang->line('active') ?>";
		var suspended = "<?php echo $this->lang->line('suspended') ?>";
		var pregnent = "<?php echo $this->lang->line('pregnent') ?>";
		var heifer = "<?php echo $this->lang->line('heifer') ?>";
		var diseased = "<?php echo $this->lang->line('diseased') ?>";
		var quarantine = "<?php echo $this->lang->line('quarantine') ?>";
		var milk_yield = "<?php echo $this->lang->line('milk_yield') ?>";
		var morning = "<?php echo $this->lang->line('morning') ?>";
		var afternoon = "<?php echo $this->lang->line('afternoon') ?>";
		var evening = "<?php echo $this->lang->line('evening') ?>";

		var milk_yield_last_10_days = "<?php echo $this->lang->line('milk_yield_last_10_days') ?>";


		

		
		
		if (animalNames == '' || animalNames == null) {
			$(".milk_yeild").hide();
		} else {
			$(".milk_yeild").show();
		}
		var options = {
			chart: {
				height: 320,
				type: "pie"
			},
			series: chartData, //[20,20,20,20,20],
			labels: [active, suspended, pregnent, heifer, diseased, quarantine],
			colors: ["#34c38f", "#5b73e8", "#f1b44c", "#50a5f1", "#0a0a0a", "#f46a6a"],
			legend: {
				show: !0,
				position: "bottom",
				horizontalAlign: "center",
				verticalAlign: "middle",
				floating: !1,
				fontSize: "14px",
				offsetX: 0
			},
			responsive: [{
				breakpoint: 600,
				options: {
					chart: {
						height: 240
					},
					legend: {
						show: !1
					}
				}
			}]
		};
		(
			chart = new ApexCharts(
				document.querySelector("#pie_chart"),
				options
			)
		).render();

		options = {
			chart: {
				height: 320,
				type: "pie"
			},
			series: CattlechartData, //[20,20,20,20,20],
			labels: [active, suspended, pregnent, heifer, diseased, quarantine],
			colors: ["#34c38f", "#5b73e8", "#f1b44c", "#50a5f1", "#0a0a0a", "#f46a6a"],
			legend: {
				show: !0,
				position: "bottom",
				horizontalAlign: "center",
				verticalAlign: "middle",
				floating: !1,
				fontSize: "14px",
				offsetX: 0
			},
			responsive: [{
				breakpoint: 600,
				options: {
					chart: {
						height: 240
					},
					legend: {
						show: !1
					}
				}
			}]
		};
		(
			chart = new ApexCharts(
				document.querySelector("#pie_chart_cattle"),
				options
			)
		).render();


		options = {
			chart: {
				height: 350,
				type: "bar",
				toolbar: {
					show: !1
				}
			},
			plotOptions: {
				bar: {
					dataLabels: {
						position: "top"
					}
				}
			},
			dataLabels: {
				enabled: !0,
				formatter: function(e) {
					return e + " Ltr"
				},
				offsetY: -20,
				style: {
					fontSize: "12px",
					colors: ["#304758"]
				}
			},
			series: [{
				name: milk_yield,
				data: animalYeildqty
			}],
			colors: ["#5b73e8"],
			grid: {
				borderColor: "#f1f1f1"
			},
			xaxis: {
				categories: animalNames,
				position: "top",
				labels: {
					offsetY: -18
				},
				axisBorder: {
					show: !1
				},
				axisTicks: {
					show: !1
				},
				crosshairs: {
					fill: {
						type: "gradient",
						gradient: {
							colorFrom: "#D8E3F0",
							colorTo: "#BED1E6",
							stops: [0, 100],
							opacityFrom: .4,
							opacityTo: .5
						}
					}
				},
				tooltip: {
					enabled: !0,
					offsetY: -35
				}
			},
			fill: {
				gradient: {
					shade: "light",
					type: "horizontal",
					shadeIntensity: .25,
					gradientToColors: void 0,
					inverseColors: !0,
					opacityFrom: 1,
					opacityTo: 1,
					stops: [50, 0, 100, 100]
				}
			},
			yaxis: {
				axisBorder: {
					show: !1
				},
				axisTicks: {
					show: !1
				},
				labels: {
					show: !1,
					formatter: function(e) {
						return e + " Ltr"
					}
				}
			},
		};
		(
			chart = new ApexCharts(
				document.querySelector("#column_chart_datalabel"),
				options
			)
		).render();


		// Daily Milk Yeild Routine Wise
		/* Waqar's Cod
		options = {
			chart: {
				height: 350,
				type: "bar",
				toolbar: {
					show: !1
				}
			},
			plotOptions: {
				bar: {
					horizontal: !1,
					columnWidth: "45%",
					endingShape: "rounded"
				}
			},
			dataLabels: {
				enabled: !1
			},
			stroke: {
				show: !0,
				width: 2,
				colors: ["transparent"]
			},
			series: [{
				name: "Morning",
				data: morningYeild
			}, {
				name: "Afternoon",
				data: afternoonYeild
			}, {
				name: "Evening",
				data: eveningYeild
			}],
			colors: ["#f1b44c", "#5b73e8", "#34c38f"],
			xaxis: {
				categories: dateYeild
			},
			yaxis: {
				title: {
					text: "Liters (Ltr)"
				}
			},
			grid: {
				borderColor: "#f1f1f1"
			},
			fill: {
				opacity: 1
			},
			tooltip: {
				y: {
					formatter: function(e) {
						return e + " Ltr."
					}
				}
			}
		};
		(chart = new ApexCharts(document.querySelector("#daily_milk_yeild_routine_wise"), options)).render();
		*/

		// New Line Chart 



      
        var options = {
			series: [{
				name: morning,
				data: morningYeild
			}, {
				name: afternoon,
				data: afternoonYeild
			}, {
				name: evening,
				data: eveningYeild
			}],
          chart: {
          height: 350,
          type: 'line',
          dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
          },
          toolbar: {
            show: false
          }, 
        },
		colors: ["#f1b44c", "#5b73e8", "#34c38f"],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: milk_yield_last_10_days,
          align: 'left'
        },
        grid: {
          borderColor: '#e7e7e7',
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        markers: {
          size: 1
        },
        xaxis: {
          categories: dateYeild
        },
        yaxis: {
          title: {
            text: "Liters (Ltr)"
          }
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          floating: true,
          offsetY: -25,
          offsetX: -5
        }
        };
		(chart = new ApexCharts(document.querySelector("#daily_milk_yeild_routine_wise"), options)).render();


		// Expense Chart
		var options = {
          series: [{
		  name: expenseChart.month,
          data: expenseChart.data
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        // colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '10%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: expenseChart.labels,
          labels: {
            style: {
            //   colors: colors,
              fontSize: '12px',
			  opacity:1
            }
          }
        },
		tooltip: {
				y: {
					formatter: function(e) {
						return e + " "+expenseChart.currency_symbol
					}
				}
			}
        };

		(chart = new ApexCharts(document.querySelector("#expense_bar_chart"), options)).render();
	<?php } ?>
</script>