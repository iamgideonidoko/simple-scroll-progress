function _075a97e0_5a16_4b1f_9288_a4aa951951bfce_(name) {
	// initialize scroll progress bar only once

	console.log("name => ", name);


	if (window._d60589dc_245b_4497_b8f6_a505a85568bf_) return;

	/**
	 *
	 *
	 * @param {*} htmlString
	 * @return {*} 
	 */
	function createNodeFromHtmlString(htmlString) {
		var div = document.createElement('div');
		div.innerHTML = htmlString.trim();
		// return first child node
		return div.firstChild;
	}

	var simple_scroll_progress_css = `
		position: fixed;
		top: 0;
		left: 0;
		height: 10px;
		background-color: #f90a23;
		height: 10px;
		transition: 0.1s ease width;
		z-index: 9999999;
		border-radius: 10rem;
	`;

	var scrollLine = createNodeFromHtmlString(`<div class="scroll-line" style="${simple_scroll_progress_css}"></div>`);
	// scrollLine.classList.add('scroll-line');

	function fillScrollLine() {
		const windowHeight = window.innerHeight;
		const fullHeight = document.body.clientHeight;
		const scrolled = window.scrollY;
		const percentScrolled = (scrolled / (fullHeight - windowHeight)) * 100;

		scrollLine.style.width = `${percentScrolled}%`;
	}
	
	/**
	 *
	 *
	 * @param {*} func
	 * @param {number} [wait=8]
	 * @param {*} immediate
	 * @return {*} 
	 */
	function debounce(func, wait = 8, immediate) {
		var timeout;
		return function () {
			var context = this,
				args = arguments;
			var later = function () {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	}

	window.addEventListener('scroll', debounce(fillScrollLine));

	window.document.body.appendChild(scrollLine);

	window._d60589dc_245b_4497_b8f6_a505a85568bf_ = true;
}