<?php require_once 'config.php';?>
<!DOCTYPE html>
<html>
<head>
<title>Demo Gird</title>
<meta charset='utf-8'>
<link rel='stylesheet' href='assets/css/style3.css'/>
</head>

<body>
<h1>Quiz AppDoc</h1>

<?php $response=mysql_query("select * from questoes");?>

<form method='post' id='quiz_form'>
<?php while($result=mysql_fetch_array($response)){ ?>
<div id="question_<?php echo $result['id'];?>" class='questions'>
<h2 id="question_<?php echo $result['id'];?>"><?php echo $result['id'].".".$result['nome_questao'];?></h2>
<div class='align'>
<input type="radio" value="1" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'>
<label id='ans1_<?php echo $result['id'];?>' for='1'><?php echo $result['resposta1'];?></label>
<br/>
<input type="radio" value="2" id='radio2_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'>
<label id='ans2_<?php echo $result['id'];?>' for='1'><?php echo $result['resposta2'];?></label>
<br/>
<input type="radio" value="3" id='radio3_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'>
<label id='ans3_<?php echo $result['id'];?>' for='1'><?php echo $result['resposta3'];?></label>
<br/>
<input type="radio" value="4" id='radio4_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'>
<label id='ans4_<?php echo $result['id'];?>' for='1'><?php echo $result['resposta4'];?></label>
<input type="radio" checked='checked' value="5" style='display:none' id='radio4_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'>
</div>
<br/>
<input type="button" id='next<?php echo $result['id'];?>' value='Next!' name='question' class='butt'/>
</div>
<?php }?>
</form>
<div id='result'>
<img src='results.jpg' alt='Results'/>
<br/>
</div>

<div id="demo1" class="demo" style="text-align:center;font-size: 25px;">00:00:00</div>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/watch.js"></script>
<script>
$(document).ready(function(){
	$('#demo1').stopwatch().stopwatch('start');
	var steps = $('form').find(".questions");
	var count = steps.size();
	steps.each(function(i){
		hider=i+2;
		if (i == 0) { 	
    		$("#question_" + hider).hide();
    		createNextButton(i);
        }
		else if(count==i+1){
			var step=i + 1;
			//$("#next"+step).attr('type','submit');
            $("#next"+step).on('click',function(){
			
			   submit();
                
            });
	    }
		else{
			$("#question_" + hider).hide();
			createNextButton(i);
		}
		
	});
    function submit(){
	     $.ajax({
						type: "POST",
						url: "ajax.php",
						data: $('form').serialize(),
						success: function(msg) {
						  $("#quiz_form,#demo1").addClass("hide");
						  $('#result').show();
						  $('#result').append(msg);
						}
	     });
	
	}
	function createNextButton(i){
		var step = i + 1;
		var step1 = i + 2;
        $('#next'+step).on('click',function(){
        	$("#question_" + step).hide();
        	$("#question_" + step1).show();
        });
	}
	setTimeout(function() {
	      submit();
	}, 600000);
});
</script>
</body>
</html>