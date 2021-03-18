/* определение id пользователя на котором был сделан
* выбор элементов, для последующей передачи его в php запрос 
* на добавление элементов.
*/
$(document).ready(function ($) {
	$('.js-cell-select').on("click", function (event) {
		let idUser = event.target.id;

		$('input[type=text]').val(idUser);
	});
});
/* открыть по клику окно выбора <select>
* в обобщенной таблице.
*/
$('.js-cell-select').on('click', function () {

	let widthScreen = $(window).width();
	let xElem = widthScreen / 2 - $(this).offset().left - 354;
	let yElem = $(this).offset().top - 272;

	$('.js-select').css('top', yElem);
	$('.js-select').css('left', xElem);

	$('.js-select').slideDown();
});
/* закрыть по клику окно выбора <select>
* в обобщенной таблице.
*/
$('.cancel').on('click', function () {

	$('.js-select').css('display', 'none');
	let idUser = NULL;
	$('input[type=text]').val(idUser);
});