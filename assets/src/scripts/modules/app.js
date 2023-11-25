class App {
	constructor($) {
		this.$ = $;
		this.offCanvas = {
			menuBar: $('.trigger-off-canvas'),
			drawer: $('.awps-offcanvas-drawer'),
			drawerClass: '.awps-offcanvas-drawer',
			menuDropdown: $('.dropdown-menu.depth_0')
		};

		$(document).ready(() => {
			this.menuDrawerOpen(this.$);
			this.offcanvasMenuToggle(this.$)
		})

		$(document).load(() => {
			// this.documentLoad();
		})
	}

	menuDrawerOpen($) {
		this.offCanvas.menuBar.on('click', e => {
			e.preventDefault();
			this.offCanvas.drawer.toggleClass('is-open');
			e.stopPropagation()
		});

		$(document).on('click', e => {
			if (!$(e.target).closest(this.offCanvas.drawerClass).length)  {
				this.offCanvas.drawer.removeClass('is-open');
			}
		});
	}

	offcanvasMenuToggle($) {
		this.offCanvas.drawer.each(function () {
			const caret = $(this).find('.caret');
			caret.on('click', function () {
				$(this).closest('li').toggleClass('is-open');
				$(this).parent().next().slideToggle(300);
			})
		})
	}

}

export default App;
