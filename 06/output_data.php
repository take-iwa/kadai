<?php

require_once("./function.php");

$title ="G's食癖アンケート結果";

//回答取得
$answer = '';
foreach ($_POST as $key => $value){
	$array[$key] = $value;
	$answer .= '"'.$value.'",';
}
$answer = mb_substr($answer, 0, -1, "UTF-8");
$answer .= "\n";

//データファイルパス設定
$filePath = "./data/data.csv";

//今のデータ書き込み
writeCsvFile($answer,$filePath);

//全データ読み込み
$records = readCsvFile($filePath);

//echo "<pre>";
//print_r( $records );
//echo "</pre>";

//集計
$resultData = aggregateData($records);

//回答者数
$number = count($resultData['user_list']);

//問いごとに結果表示用データ取得
//Q１
$resultDataQ1 = getDataForDisplay($resultData['たい焼き']);
$answerlistQ1 = json_safe_encode($resultDataQ1['ans']);
$numberlistQ1 = json_safe_encode($resultDataQ1['num']);
//Q2
$resultDataQ2 = getDataForDisplay($resultData['あんこ']);
$answerlistQ2 = json_safe_encode($resultDataQ2['ans']);
$numberlistQ2 = json_safe_encode($resultDataQ2['num']);
//Q3
$resultDataQ3 = getDataForDisplay($resultData['おむすび']);
$answerlistQ3 = json_safe_encode($resultDataQ3['ans']);
$numberlistQ3 = json_safe_encode($resultDataQ3['num']);
//Q4
$resultDataQ4 = getDataForDisplay($resultData['目玉焼き']);
$answerlistQ4 = json_safe_encode($resultDataQ4['ans']);
$numberlistQ4 = json_safe_encode($resultDataQ4['num']);
//Q5
$resultDataQ5 = getDataForDisplay($resultData['トマト']);
$answerlistQ5 = json_safe_encode($resultDataQ5['ans']);
$numberlistQ5 = json_safe_encode($resultDataQ5['num']);

?>
	<html>

	<head>
		<meta charset="utf-8">
		<title>
			<?php echo $title; ?>
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
		<link rel="icon" href="./img/favicon.ico">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>

	<body>
		<img id="top_img" src="./img/cook.jpg" alt="logo" style="margin:0;" />
		<h1>
			<?=$title?>
		</h1>
		<p>ご協力ありがとうございました。集計結果は、こんな感じです。</p>
		<div id="result_area">
			<p class="question">回答者数：
				<?=$number?>名
			</p>
			<br>
			<p class="question">Q１. たいやき はどっちから食べる？</p>
			<div id="result_q1">
				<canvas id="graph_q1" class="pie_graph"></canvas>
				<div id="text_q1" class="text_sonota">
					<p>
						<?=$resultDataQ1['txt']?>
					</p>
				</div>
			</div><br>
			<p class="question">Q2. あんこ といえば？</p>
			<div id="result_q2">
				<canvas id="graph_q2" class="pie_graph"></canvas>
				<div id="text_q2" class="text_sonota">
					<p>
						<?=$resultDataQ2['txt']?>
					</p>
				</div>
			</div><br>
			<p class="question">Q3. コンビニのおむすびの具 と言えば？</p>
			<div id="result_q3">
				<canvas id="graph_q3" class="pie_graph"></canvas>
				<div id="text_q3" class="text_sonota">
					<p>
						<?=$resultDataQ3['txt']?>
					</p>
				</div>
			</div><br>
			<p class="question">Q4. 目玉焼き には、何をかけますか？</p>
			<div id="result_q4">
				<canvas id="graph_q4" class="pie_graph"></canvas>
				<div id="text_q4" class="text_sonota">
					<p>
						<?=$resultDataQ4['txt']?>
					</p>
				</div>
			</div><br>
			<p class="question">Q5. では、トマト には、何をかけますか？</p>
			<div id="result_q5">
				<canvas id="graph_q5" class="pie_graph"></canvas>
				<div id="text_q5" class="text_sonota">
					<p>
						<?=$resultDataQ5['txt']?>
					</p>
				</div>
			</div>
		</div>
		<p id="end">お疲れ様でした。</p>
		<script>
			Chart.defaults.global.defaultFontFamily = "'KTEGAKI',sans-serif";
			Chart.defaults.global.defaultFontSize = 18;
			//Q1
			var ctx_q1 = document.getElementById('graph_q1').getContext('2d');
			var chart_q1 = new Chart(ctx_q1, {
				// The type of chart we want to create
				type: 'doughnut',

				// The data for our dataset
				data: {
					labels: <?php echo $answerlistQ1; ?>,
					datasets: [{
						label: "Q１",
						backgroundColor: ["#2ecc71",
							"#3498db",
							"#95a5a6",
							"#9b59b6",
							"#f1c40f",
							"#e74c3c",
							"#34495e"
						],
						data: <?php echo $numberlistQ1; ?>
					}]
				},

				// Configuration options go here
				options: {}
			});

			//Q2
			var ctx_q2 = document.getElementById('graph_q2').getContext('2d');
			var chart_q2 = new Chart(ctx_q2, {
				// The type of chart we want to create
				type: 'doughnut',

				// The data for our dataset
				data: {
					labels: <?php echo $answerlistQ2; ?>,
					datasets: [{
						label: "Q2",
						backgroundColor: [
							"#DE5B49",
							"#E37B40",
							"#F0CA4D",
							"#46B29D",
							"#344F5E",
							"#868686"
						],
						data: <?php echo $numberlistQ2; ?>
					}]
				},

				// Configuration options go here
				options: {}
			});

			//Q3
			var ctx_q3 = document.getElementById('graph_q3').getContext('2d');
			var chart_q3 = new Chart(ctx_q3, {
				// The type of chart we want to create
				type: 'doughnut',

				// The data for our dataset
				data: {
					labels: <?php echo $answerlistQ3; ?>,
					datasets: [{
						label: "Q3",
					backgroundColor: [
						"#de6c30",
						"#d93e2e",
						"#4ec6c9",
						"#88561c",
						"#e062a6",
						"#9ca32d",
						"#d1cfd6",
						"#485355"
						],
						data: <?php echo $numberlistQ3; ?>
					}]
				},

				// Configuration options go here
				options: {}
			});

			//Q4
			var ctx_q4 = document.getElementById('graph_q4').getContext('2d');
			var chart_q4 = new Chart(ctx_q4, {
				// The type of chart we want to create
				type: 'doughnut',

				// The data for our dataset
				data: {
					labels: <?php echo $answerlistQ4; ?>,
					datasets: [{
						label: "Q4",
					backgroundColor: [
							"#342828",
							"#d9833c",
							"#cbd5e2",
							"#d15e74",
							"#e6bc49",
							"#615562",
							"#4f575f"
						],
						data: <?php echo $numberlistQ4; ?>
					}]
				},

				// Configuration options go here
				options: {}
			});

			//Q5
			var ctx_q5 = document.getElementById('graph_q5').getContext('2d');
			var chart_q5 = new Chart(ctx_q5, {
				// The type of chart we want to create
				type: 'doughnut',

				// The data for our dataset
				data: {
					labels: <?php echo $answerlistQ5; ?>,
					datasets: [{
						label: "Q１",
						backgroundColor: [
							"#e34f33",
							"#3e9bd9",
							"#3dbc4c",
							"#9b59b6",
							"#e6cd67",
							"#584d4c",
							"#c8cbce"
						],
						data: <?php echo $numberlistQ5; ?>
					}]
				},

				// Configuration options go here
				options: {}
			});

		</script>
	</body>

	</html>
