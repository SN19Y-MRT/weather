<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>週間天気予報</title>
</head>
<body>
<script>
    const url = 'https://api.open-meteo.com/v1/forecast?latitude=34.686320&longitude=135.520022&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=Asia%2FTokyo';


    fetch(url)
    .then(data => data.json())
    .then(json => console.log(json))
    
    window.addEventListener('load', function() {
  getTrainList();
});

function getTrainList() {
  var url = 'https://tetsudo.rti-giken.jp/free/delay.json'; //遅延情報のJSON
  fetch(url)
  .then(function (data) {
    return data.json(); // 読み込むデータをJSONに設定
  })
  .then(function (json) {
    for (var i = 0; i < json.length; i++) {
      var train = json[i].name;
      var company = json[i].company;

      //表形式で遅延路線を表示する
      var row = document.getElementById('train-list').insertRow();
      row.insertCell().textContent = i + 1;
      row.insertCell().textContent = train;
      row.insertCell().textContent = company;
    }
  });
}
</script>
<h1>遅延路線</h1>
      <table id="train-list">
      </table>
</body>
</html>