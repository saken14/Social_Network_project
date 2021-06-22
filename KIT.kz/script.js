//show password
function showPassword() {
    var n = document.getElementById("password");
    if(n.type === "password") {
        n.type = "text";
    }
    else {
        n.type = "password";
    }
}
function showPassword2() {
    var n = document.getElementById("password2");
    if(n.type === "password") {
        n.type = "text";
    }
    else {
        n.type = "password";
    }
}
function showPassword3() {
    var n = document.getElementById("password3");
    if(n.type === "password") {
        n.type = "text";
    }
    else {
        n.type = "password";
    }
}






//set cookie function
function setCookie(name, value) { 
    document.cookie = name + "=" + value + ";"; 
}






//switcher
var switcher = document.getElementById("switcher");
var body = document.querySelector("body");
var header = document.querySelector("header");
var sidebar = document.getElementsByClassName("sidebar");
var content = document.querySelector(".content");

//checking if it is turned on initially
if(switcher.getAttribute("data-isTurnedOn") == 'on') {
    $('#switcher').addClass("active");
    $("body").addClass("active");
    $("header").addClass("bg_active");

    $(".sidebar").addClass("bg_active");
    $(".content").addClass("bg_active");
}
//click on switcher
$("div#switcher").off().click(function () {

    if(switcher.getAttribute("data-isTurnedOn") == 'off') {
        jQuery('#switcher').addClass("active");
        jQuery('body').addClass("active");
        jQuery('header').addClass("bg_active");

        for(var i=0; i<sidebar.length; i++) {
            sidebar[i].classList.toggle("bg_active");
        }
        jQuery('.content').addClass("bg_active");
        switcher.setAttribute("data-isTurnedOn", "on");
        setCookie("sw", 'on');
    }
    else {
        $('#switcher').removeClass("active");
        $("body").removeClass("active");
        $("header").removeClass("bg_active");

        $(".sidebar").removeClass("bg_active");
        $(".content").removeClass("bg_active");

        switcher.setAttribute("data-isTurnedOn", "off");
        setCookie("sw", 'off');
    }
})







//scroll-To-Top
$(function() {
    $.fn.scrollToTop = function() {

        $(this).hide().removeAttr("href");

        if ($(window).scrollTop() >= "250") 
            $(this).fadeIn("slow")

        var scrollDiv = $(this);

        $(window).scroll(function() {
            if ($(window).scrollTop() <= "250") 
                $(scrollDiv).fadeOut("slow")
            else 
                $(scrollDiv).fadeIn("slow")
        });

        $(this).click(function() {
            $("html, body").animate({scrollTop: 0}, "slow")
        })
    }
});
  
$(function() {
    $("#go_top").scrollToTop();
});







//like post 
$(document).ready(function () {
    $("body").off().on("click", "button.like", function () {
        var btn = $(this);
        var post_id = btn.data("post_id");
        var user_id = btn.data("user_id");
        var icon = $("#path" + post_id);
        var like_span = $(".like_span" + post_id);

        $.ajax({
            url: "like_btn.php",
            method: "POST",
            dataType: "json",
            data: {post_id: post_id, user_id: user_id}
        })
        .done(function (result) {
            if(!result.error) {
                console.log(result);
                icon.addClass("liked");
                if(result.isActive) {
                    like_span.html(result.like_count);
                    icon.addClass("liked");
                    $(".svg_img_btn.id" + post_id).addClass("anim_like");
                }
                else {
                    like_span.html(result.like_count);
                    icon.removeClass("liked");
                    $(".svg_img_btn.id" + post_id).removeClass("anim_like");
                }
            }
            else {
                alert(result.message);
            }
        })
    });
});







//add image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#preview_img').attr('src', e.target.result);
            var a = document.getElementById("preview_img");
            var b = document.getElementsByClassName("preview_modal")[0];
            a.style.display = "block";
            b.style.display = "block";
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#inp_img").change(function() {
    readURL(this);
});

//view image  photos.php
$("img.img_item").click(function () {
    var img = $(this);
    var img_id = img.data("img_id");
    var user = img.data("user");
    var pub = img.data("date");
    var clickedImg = document.querySelector('.img_item[data-img_id="'+img_id+'"]');
    var srcOfClickedImg = clickedImg.getAttribute("src");

    //giving scr of clicked img to modal img
    var viewImg = $("#view_img");
    var temp_src = viewImg.attr('src', srcOfClickedImg);

    //change to block from none
    var a = document.getElementById("view_img");
    var b = document.getElementsByClassName("view_modal")[0];
    a.style.display = "block";
    b.style.display = "block";

    //hide img
    window.onclick = function(event) {
        if (event.target == b) {
            b.style.display = "none";
        }
    }

    //append data of img to delete button
    var d_img = $("span.del_img");
    d_img.attr("data-delete_id", img_id);
    d_img.attr("data-user_id", user);

    //append pub date to img
    document.querySelector(".pub_date").innerHTML = "Published: " + pub;
})









//add video
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#preview_img').attr('src', e.target.result);
            var a = document.getElementById("preview_img");
            var b = document.getElementsByClassName("preview_modal")[0];
            a.style.display = "block";
            b.style.display = "block";
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#inp_vid").change(function() {
    readURL(this);
});

//view video
$("video.img_item").click(function () {
    var img = $(this);
    var img_id = img.data("img_id");
    var user = img.data("user");
    var pub = img.data("date");
    var clickedImg = document.querySelector('.img_item[data-img_id="'+img_id+'"]');
    var srcOfClickedImg = clickedImg.getAttribute("src");

    //giving scr of clicked img to modal img
    var viewImg = $("#view_img");
    var temp_src = viewImg.attr('src', srcOfClickedImg);

    //change to block from none
    var a = document.getElementById("view_img");
    var b = document.getElementsByClassName("view_modal")[0];
    a.style.display = "block";
    b.style.display = "block";

    //hide img and pause video
    window.onclick = function(event) {
        if (event.target == b) {
            b.style.display = "none";
            a.pause();
        }
    }

    //append data of img to delete button
    var d_img = $("span.del_img");
    d_img.attr("data-delete_id", img_id);
    d_img.attr("data-user_id", user);

    //append pub date to img
    document.querySelector(".pub_date").innerHTML = "Published: " + pub;
})





//view image  home.php
$(".content").on("click", "img.post_img", function () {
    //console.log("click");
    
    var img = $(this);
    var img_name = img.data("img_name");
    var pub = img.data("date");
    var author = img.data("author");
    var user_id = img.data("user_id");
    var post_like = img.data("post_like");
    
    var clickedImg = document.querySelector('.post_img[data-img_name="'+img_name+'"]');
    var srcOfClickedImg = clickedImg.getAttribute("src");

    //giving scr of clicked img to modal img
    var viewImg = $("#view_img");
    var temp_src = viewImg.attr('src', srcOfClickedImg);

    //change to block from none
    var a = document.getElementById("view_img");
    var b = document.getElementsByClassName("view_modal")[0];
    a.style.display = "block";
    b.style.display = "block";

    //hide img
    window.onclick = function(event) {
        if (event.target == b) {
            b.style.display = "none";
        }
    }

    //append pub date to img
    document.querySelector(".pub_date").innerHTML = "Published: " + pub;

    document.getElementById("authorOfPostA").setAttribute("href", "user_profile.php?u_id=" + user_id);

    //append author of post to img
    document.querySelector(".authorOfPost").innerHTML = author;

    //append like of post to img
    if(post_like == 1) {
        document.querySelector(".post_likeOnImageView").innerHTML = post_like + " like";
    }
    else {
        document.querySelector(".post_likeOnImageView").innerHTML = post_like + " likes";
    }
});



