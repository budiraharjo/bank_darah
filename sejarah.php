<!DOCTYPE HTML>
<html>
<head><meta name="viewport" content="width=device-width"/>
<title>Bank Darah </title>
<link rel="icon" href="images/logo.png" type="image/png">
<!-- STYLES & JQUERY 
================================================== -->
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/icons.css"/>
<link rel="stylesheet" type="text/css" href="css/skinblue.css"/><!-- Change skin color here -->
<link rel="stylesheet" type="text/css" href="css/responsive.css"/>
<script src="js/jquery-1.9.0.min.js"></script><!-- scripts are at the bottom of the document -->
</head>
<body>
<div class="boxedtheme">
<!-- TOP LOGO & MENU
================================================== -->
<div class="grid">
	<div class="row space-bot">
		<!--Logo-->
		<div class="c4">
			<a href="index.html">
			<img src="images/logo.png" class="logo" alt="">
			</a>
		</div>
		<!--Menu-->
		<?php
		include "menu_head.php";
		?>
	</div>
</div>
<!-- HEADER
================================================== -->
<div class="undermenuarea">
	<div class="boxedshadow">
	</div>
	<div class="grid">
		<div class="row">
			<div class="c8">
				<h1 class="titlehead">Sejarah UTD PMI</h1>
			</div>
			<div class="c4">
				<h1 class="titlehead rightareaheader"><i class="icon-map-marker"></i> Pandeglang</h1>
			</div>
		</div>
	</div>
</div>
<!-- CONTENT
================================================== -->
<div class="grid">
		<div class="shadowundertop"></div>
		<div class="row">
			<div class="c8">
				<h1 class="maintitle" style="font-size:15px; line-height: 1.5em;">
				<span>Unit Transfusi Darah PMI Cabang Pandeglang</span>
				</h1>
				<p align="justify">
					<span class="dropcap">P</span>alang Merah Indonesia (PMI) adalah suatu organisasi yang bergerak di bidang sosial dengan tujuan yang mulia yang dibentuk pada tanggal 17 September 1945. Sebagai badan hukum, Pemerintah Republik Indonesia mengesahkan keberadaan dan tugas PMI melalu kepres Nomor 25 tahun 1959 dan diperkuat dengan kepres nomor 264 tahun 1963.&nbsp;
					</br>Pada Musyawarah Nasional Palang Merah Indonesia ke XIV di jakarta pada tahun 1986 dari nama Dinas Transfusi Darah (DTD) telah diubah menjadi Upaya Pelayanan Transfusi Darah (UPTD) pada nama UPTD ini tidak lama diganti lagi pada tahun 1994 dikarenakan pada kalimat "Upaya Pelayanan” bersifat komersial sehingga diubah menjadi Unit Transfusi Darah (UTD) dengan nama Unit Transfusi Darah. 
					&nbsp;
					</br>Upaya peningkatan para pendonor darah yang sukarela di Di Unit Transfusi Darah Palang Merah Indonesia Cabang Pandegalng sejak didirikan hingga sekarang yaitu sekabupaten Pandeglang ditunjang oleh Surat Keputusan Presiden nomor 246 Tanggal 29 November 1963, melalui keppres ini pemerintah Republi Indonesia mengesahkan "Tugas pokok dan kegiatan-kegaitan Palang Merah Indonesia (PMI) yang berasaskan perikemanusiaan dan atas dasar sukarela dengan tidak membeda-bedakan golongan, bangsa, dan paham politik".

				</p>
				
			</div>
			<div class="c4">
				<h1 class="maintitle">
				<span> </span>
				</h1>
				<ul id="skill">
					<li><span class="bar progressdefault" style="width:100%;"></span>
					<h3> </h3>
					</li>
					<li><span class="bar progressdefault" style="width:80%;"></span>
					<h3> </h3>
					</li>
					<li><span class="bar progressdefault" style="width:60%;"></span>
					<h3> </h3>
					</li>
				</ul>
			</div>
		</div>
		
		 </br>
		 </br>
		 </br>
		 </br>
		
</div><!-- end grid -->

<!-- FOOTER
================================================== -->
<?php
include "footer.php";
?>
</div>
<!-- JAVASCRIPTS
================================================== -->
<!-- all-->
<script src="js/modernizr-latest.js"></script>

<!-- menu & scroll to top -->
<script src="js/common.js"></script>

<!-- testimonial rotator -->
<script src="js/jquery.cycle.js"></script>

<!-- twitter -->
<script src="js/jquery.tweet.js"></script>

<!-- cycle -->
<script src="js/jquery.cycle.js"></script>

<!-- carousel items -->
<script src="js/jquery.carouFredSel-6.0.3-packed.js"></script>

<!-- CALL Showcase - change 5 from min:5 and max:5 to the number of items you want visible -->
<script type="text/javascript">
$(window).load(function(){			
			$('#recent-projects').carouFredSel({
				responsive: true,
				width: '100%',
				auto: true,
				circular	: true,
				infinite	: false,
				prev : {
					button		: "#car_prev",
					key			: "left",
						},
				next : {
					button		: "#car_next",
					key			: "right",
							},
				swipe: {
					onMouse: true,
					onTouch: true
					},
				scroll : 2000,
				items: {
					visible: {
						min: 5,
						max: 5
					}
				}
			});
		});	
</script>

<!-- CALL opacity on hover images -->
<script type="text/javascript">
$(document).ready(function(){
    $("img.imgOpa").hover(function() {
      $(this).stop().animate({opacity: "0.6"}, 'slow');
    },
    function() {
      $(this).stop().animate({opacity: "1.0"}, 'slow');
    });
  });
</script>

<!-- CALL tabs -->
<script type="text/javascript">
$(document).ready(function() {	
	$('#tabs li a:not(:first)').addClass('inactive');
	$('.container:not(:first)').hide();	
	$('#tabs li a').click(function(){		
		var t = $(this).attr('href');
		if($(this).hasClass('inactive')){ //added to not animate when active
			$('#tabs li a').addClass('inactive');		
			$(this).removeClass('inactive');
			$('.container').hide();
			$(t).fadeIn('slow');	
		}			
		return false;
	}) //end click
});
</script>
</body>
</html>