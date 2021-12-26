var dataAPI = "./data.json";


function start() {
    getCourse(renderCourse);
}

start();


//Function

function getCourse(callback) {
    fetch(dataAPI)
        .then(function(respone) {
            return respone.json();
        })
        .then(callback);
}

function renderCourse(courses) {
    var listCourse = $('.listC');
    var htmls = courses.map(function(course) {
        return `
            <li>
                <h1>${course.name}</h1>
                <p>${course.description}</p>
            </li>
        `
    });

    listCourse.html(htmls);
    console.log("ok");


}


//ajax k load lại trang
//$('.menu').on("click", "a", function() {
//  var hrf = $(this).attr("href");
//var lin = hrf.substring(1, hrf.length);
// alert(lin);
// $('.main-top').load(lin);
//})
$('.phantrang').on("click", "a", function() {
    $(this).siblings().removeClass('act');
    $(this).addClass('act');
    var page = $(this).text();
    alert(page);
    $.post("view.html", {
            page: page
        },
        function(data, textStatus, jqXHR) {
            $('.container').html(data);
        }
    )
})