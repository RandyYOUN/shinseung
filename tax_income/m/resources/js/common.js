$(document).ready(function () {
	popup();
});

function popup() {

	$(".layer_bg, .layer_wrap").hide();

	function layer_position(no) {

		var win_W = $(window).width();
		var win_H = $(window).height();
		var pop_W = $(".layer_wrap[layer=" + no + "]").width();
		var pop_H = $(".layer_wrap[layer=" + no + "]").height();
		var left = ($(window).scrollLeft() + (win_W - pop_W) / 2);
		var top = ($(window).scrollTop() + (win_H - pop_H) / 2);
		if (top < 0) { top = 0; }
		if (left < 0) { left = 0; }

		$(".layer_wrap[layer=" + no + "]").css({ 'left': left, 'top': top });
	};

	function layer_open(no) {
		$(".layer_wrap[layer=" + no + "]").fadeIn();
		$(".layer_bg").fadeIn();
		layer_position(no);

		$(".layer_bg").click(function (e) {
			if (!$(".layer_wrap").has(e.target).length) {
				layer_close(no);
			};
		});
	};

	function layer_close(no) {
		$(".layer_wrap[layer=" + no + "]").css("display", "none");
		$(".layer_bg").css("display", "none");
	};

	$(".btn_layer").click(function (no) {
		var no = $(this).attr("layer");
		layer_open(no);
	});

	$(".btn_close").click(function (no) {
		var no = $(this).attr("layer");
		layer_close(no);
	});

	$(window).resize(function () {
		layer_position();
	});
}