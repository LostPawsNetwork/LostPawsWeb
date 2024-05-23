var x = -18.0038097;
var y = -70.238896;
var acercamiento = 18;

var map = L.map("map").setView([x, y], acercamiento);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution: "LostPaws",
}).addTo(map);

var marker = L.marker([x, y]).addTo(map);
