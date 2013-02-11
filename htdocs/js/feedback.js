var feed = document.getElementById("FeedSite");
feed.style.display = 'none';
feed.value = '';

var last_id = '';
function show(click_id) {
 if (last_id) {
  var sm = document.getElementById('b' + last_id);
  sm.style.display = 'none';
 }
 if (last_id == click_id) {
  last_id = '';
 } else {
  last_id = click_id;
  var sm = document.getElementById('b' + click_id);
  sm.style.display = '';
 }
}
function changeImage (id, image) {
 var element = document.getElementById(id);
 element.src = image;
}