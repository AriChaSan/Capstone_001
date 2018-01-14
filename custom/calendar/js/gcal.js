var generateUrl = require('generate-google-calendar-url');

var url = generateUrl({
  start: new Date(2015, 7, 20, 18),
  end: new Date(2015, 7, 20, 21),
  title: 'YAPC::Asia Tokyo 2015 前夜祭',
  location: '東京ビッグサイト会議棟 (Tokyo Bigsight) 6F、7F',
  details: 'http://yapcasia.org/2015/'
});

console.log('- <a href="' + url + '">YAPC::Asia Tokyo 2015 前夜祭 を Google Calendar に追加</a>');

var url = generateUrl({
  start: new Date(2015, 7, 21, 10),
  end: new Date(2015, 7, 21, 18),
  title: 'YAPC::Asia Tokyo 2015 Day 1',
  location: '東京ビッグサイト会議棟 (Tokyo Bigsight) 6F、7F',
  details: 'http://yapcasia.org/2015/'
});

console.log('- <a href="' + url + '">YAPC::Asia Tokyo 2015 Day 1 を Google Calendar に追加</a>');

var url = generateUrl({
  start: new Date(2015, 7, 21, 18),
  end: new Date(2015, 7, 21, 23, 59),
  title: 'YAPC::Asia Tokyo 2015 Day 1 (懇親会)',
  location: '東京ビッグサイト会議棟 (Tokyo Bigsight) 6F、7F',
  details: 'http://yapcasia.org/2015/'
});

console.log('- <a href="' + url + '">YAPC::Asia Tokyo 2015 Day 1 (懇親会) を Google Calendar に追加</a>');

var url = generateUrl({
  start: new Date(2015, 7, 22, 10, 30),
  end: new Date(2015, 7, 22, 19),
  title: 'YAPC::Asia Tokyo 2015 Day 2',
  location: '東京ビッグサイト会議棟 (Tokyo Bigsight) 6F、7F',
  details: 'http://yapcasia.org/2015/'
});

console.log('- <a href="' + url + '">YAPC::Asia Tokyo 2015 Day 2 を Google Calendar に追加</a>');