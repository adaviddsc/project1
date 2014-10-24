
$(function() {
  $("#sex-form").submit(function() {
    $.ajax({
      data: $(this).serialize(),
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      success: function(response) {
        $("#alert-info h2").html(response);
      }
    });
    return false;
  });

  if(sex == "male"){
    $("#sex-form-container-down input[value=male]").attr("checked", true);
  }
  else if(sex == "female"){
    $("#sex-form-container-down input[value=female]").attr("checked", true);
  }
  else{
    $(".dialog-radio").attr("checked", false);
  }
  if (cookie!=""){
    $('.dialog-input').attr('readonly', true);
    $('.dialog-radio').attr('onclick','return false');
    $('.dialog-button').css('display', 'none');
    $('.dialog-input').attr('type', 'text');
    $('.dialog-input').css('background-color', '#DFE8EC');
    $('.dialog-input').css('border', 'none');
    $('.dialog-input').css('box-shadow', 'inset 0 0px 0px rgba(0, 0, 0, 0.075)');
    $('.dialog-input').css('cursor', 'default');
    $('.dialog-input').css('font-size', '2.2rem');
  }
});

