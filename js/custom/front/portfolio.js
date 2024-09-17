$(document).ready(function () {
    if(cat_id!=''){
        cat_id = cat_id;
        
        if($('a#active_'+cat_id+'').hasClass('active')==false){
            //alert($('ul.visible_nav').find('.active + a').attr('id'));
            $('ul.visible_nav').find('.active').removeClass('active');
            $('ul.visible_nav').find('a#active_'+parseInt(cat_id)).attr('class','active')
        }
    }else{
     cat_id = $('a.active input#parentcategory').val();   
    }
    
    $.ajax({
        async: false,
        type: "POST",
        url: "front/home/get_sub_category",
        data: "cat_id=" + cat_id,
        success: function (data) {
            var data = $.parseJSON(data);
            var string = '';
            $(data).each(function(i,v){
                if(i==0){
                    //sub_cat_id = v.sub_cat_Id;
                    string += '<option class="active" id="active_'+v.sub_cat_Id+'" value="'+v.sub_cat_Id+'">'+v.sub_cat_Name+'</option>' 
                }else{
                    string += '<option id="active_'+v.sub_cat_Id+'" value="'+v.sub_cat_Id+'">'+v.sub_cat_Name+'</option>'; 
                }
               
            });
            $('select.category_nav_responsive').append(string);
        }
    });
    var sub_cat_id = $('select.category_nav_responsive option.active').val();
    
    $.ajax({
        type: "POST",
        url: "front/home/get_project_by_category",
        data: "sub_cat_id=" + sub_cat_id,
        success: function (data) {
            var data = $.parseJSON(data);
            var string = '';
           $(data).each(function(i,v){
               if(i%2==0){
                   string += '<a href="'+v.url+'" target="_blank" class="left"><img src="images/project_image/'+v.image+'" alt="'+v.title+'" /></a>' 
               }else{
                  string += '<a href="'+v.url+'" target="_blank" class="right"><img src="images/project_image/'+v.image+'" alt="'+v.title+'" /></a>' 
               }
               
           });
           string+=  '<div style="clear:both;"></div>'
           $('div.website_category_single').append(string);
        }
    });
});


$('select.category_nav_responsive').live('change', function (evt) {
   $('select.category_nav_responsive option.active').removeClass('active');
   $(this).find('option#active_'+$(this).val()+'').attr('class','active');
    $.ajax({
        type: "POST",
        url: "front/home/get_project_by_category",
        data: "sub_cat_id=" + $(this).val(),
        success: function (data) {
            $('div.website_category_single').html('');
            var data = $.parseJSON(data);
            var string = '';
           $(data).each(function(i,v){
               if(i%2==0){
                   string += '<a href="'+v.url+'" target="_blank" class="left"><img src="images/project_image/'+v.image+'" alt="'+v.title+'" /></a>' 
               }else{
                  string += '<a href="'+v.url+'" target="_blank" class="right"><img src="images/project_image/'+v.image+'" alt="'+v.title+'" /></a>' 
               }
               
           });
           string+=  '<div style="clear:both;"></div>'
           $('div.website_category_single').append(string);
        }
    });
});


$('ul.visible_nav li').live('click',function(e){
   $('div.website_category_single').html('');
   $(this).parents('ul.visible_nav').find('a.active').removeClass('active');
   $(this).find('a').attr('class','active');
   var cat_id = $(this).find('input#parentcategory').val();
   $('select.category_nav_responsive').html('');
    $.ajax({
        async: false,
        type: "POST",
        url: "front/home/get_sub_category",
        data: "cat_id=" + cat_id,
        success: function (data) {
            var data = $.parseJSON(data);
            var string = '';
            $(data).each(function(i,v){
                if(i==0){
                    //sub_cat_id = v.sub_cat_Id;
                    string += '<option class="active" id="active_'+v.sub_cat_Id+'" value="'+v.sub_cat_Id+'">'+v.sub_cat_Name+'</option>' 
                }else{
                    string += '<option id="active_'+v.sub_cat_Id+'" value="'+v.sub_cat_Id+'">'+v.sub_cat_Name+'</option>'; 
                }
               
            });
            $('select.category_nav_responsive').append(string);
        }
    });
    
     var sub_cat_id = $('select.category_nav_responsive option.active').val();
    
    $.ajax({
        type: "POST",
        url: "front/home/get_project_by_category",
        data: "sub_cat_id=" + sub_cat_id,
        success: function (data) {
            var data = $.parseJSON(data);
            var string = '';
           $(data).each(function(i,v){
               if(i%2==0){
                   string += '<a href="'+v.url+'" target="_blank" class="left"><img src="images/project_image/'+v.image+'" alt="'+v.title+'" /></a>' 
               }else{
                  string += '<a href="'+v.url+'" target="_blank" class="right"><img src="images/project_image/'+v.image+'" alt="'+v.title+'" /></a>' 
               }
               
           });
           string+=  '<div style="clear:both;"></div>'
           $('div.website_category_single').append(string);
        }
    });
})

$('div#carousel_set_1 div.carousel_slide').live('click',function(){
   alert('test');
   alert($(this).siblings('input#single_project').val())
})