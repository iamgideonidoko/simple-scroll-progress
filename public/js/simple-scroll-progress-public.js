function _075a97e0_5a16_4b1f_9288_a4aa951951bfce_(payload) {
	// initialize scroll progress bar only once

	// check if payload is a valid one
	if (!typeof payload === 'object' || !payload.hasOwnProperty('color') || !payload.hasOwnProperty('height') || !payload.hasOwnProperty('zindex') || !payload.hasOwnProperty('cap')) return;

	const { color, height, zindex, cap } = payload;

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
		height: ${height}px;
		background-color: ${color};
		transition: 0.1s ease width;
		z-index: ${zindex};
		border-top-right-radius: ${cap === 'curve' ? '100rem' : 0};
		border-bottom-right-radius: ${cap === 'curve' ? '100rem' : 0};
	`;

	var scrollLine = createNodeFromHtmlString(`<div class="scroll-line" style="${simple_scroll_progress_css}"></div>`);

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

	// so it doesn't get called twice
	window._d60589dc_245b_4497_b8f6_a505a85568bf_ = true;
}