$(function() {
	for (count=0;count<c;count++){
		if (count%2==0){
			$('.search-result-container').append('<div class="search-result odd" title="'+searchUsername[count]+'"><div class="search-result-photo"><img src="'+searchPhoto[count]+'"></div><div class="search-result-info"><div class="search-result-info-div"><img src="images/id.png"><h1>'+searchUser[count]+'</h1></div><div class="search-result-info-div"><i class="fa fa-envelope-o"></i><h1>'+searchEmail[searchUsername[count]]+'</h1></div><div class="search-result-info-div"><img src="images/birthday.png"><h1>'+searchBirth[searchUsername[count]]+'</h1></div><div class="search-result-info-div"><i class="fa fa-male sex"></i><i class="fa fa-female sex"></i><h1>'+searchSex[searchUsername[count]]+'</h1></div></div></div><div class="dashed"></div>');
		}
		if (count%2==1){
			$('.search-result-container').append('<div class="search-result even" title="'+searchUsername[count]+'"><div class="search-result-photo"><img src="'+searchPhoto[count]+'"></div><div class="search-result-info"><div class="search-result-info-div"><img src="images/id.png"><h1>'+searchUser[count]+'</h1></div><div class="search-result-info-div"><i class="fa fa-envelope-o"></i><h1>'+searchEmail[searchUsername[count]]+'</h1></div><div class="search-result-info-div"><img src="images/birthday.png"><h1>'+searchBirth[searchUsername[count]]+'</h1></div><div class="search-result-info-div"><i class="fa fa-male sex"></i><i class="fa fa-female sex"></i><h1>'+searchSex[searchUsername[count]]+'</h1></div></div></div><div class="dashed"></div>');
		}
	}
	$(".search-result").on('click',function(event){

    	if ( $(this).attr("title")=="session" ){
			document.location.href="self.php";
		}
		else{
			SetCookie("profileID",$(this).attr("title"));	
			document.location.href="profile.php";
		}
	});
});