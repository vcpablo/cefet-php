(function(app){
	var GameService = function() {
		var todosOsGames = function() {
			var jqXhr;
			return $.get('api/games');
		};

		var removerGame = function(id) {
			var jqXhr;
			return $.ajax({
				method:"DELETE",
				url:"api/games/" + id
			});
		};

		this.todosOsGames = todosOsGames;
		this.removerGame = removerGame;
	};


	var GameListController = function(service) {
		var _service = service;

		var desenhar = function(games, target) {
			var html = '';

			if(games.length > 0) {
				html += '<table class="table table-striped table-responsive">' + 
				'<tr><th>Id</th><th>Nome</th><th>Lançamento</th></tr>';

				games.forEach(function(value, index) {	
					html += '<tr data-id="' + value.id + '">' + 
					'<td>' + value.id + '</td>' +
					'<td>' + value.nome + '</td>' +
					'<td>' + value.lancamento + '</td>' +
					'</tr>';
				});

				html += '</table>';
			}

			$(target).html(html);

			var selecionaLinha = function() {
				var element = $(this);

				$("tr").each(function(){
					if($(this).hasClass("selecionada") && element.data("id") !== $(this).data("id")) {
						$(this).removeClass("selecionada");
					}
				});

				element.toggleClass("selecionada");

			};

			$("tr").click(selecionaLinha)
		}

		var iniciar = function() {
			var promise = _service.todosOsGames();

			promise.done(function(data, textStatus, jqXhr) {
				desenhar(data, "#games");
			});

			promise.fail(function(jqXhr, textStatus, errorThrown) {
				alert(errorThrown);
			});
		}

		var obterLinhaSelecionada = function() {
			return ($(".selecionada").data("id") !== undefined) ? $(".selecionada").data("id") : -1;
		};


		var remover = function() {
			var linhaSelecionada = obterLinhaSelecionada();
			console.log(linhaSelecionada)

			if(linhaSelecionada !== -1) {
				if(confirm("Deseja remover o game com id #" + linhaSelecionada)) {
					var promise = _service.removerGame(linhaSelecionada);

					promise.done(function(data, textStatus, jqXhr) {
						alert(data);
						$(".selecionada").remove();

					});

					promise.fail(function(jqXhr, textStatus, errorThrown) {
						alert(errorThrown);
					});
				}
			}
		};

		this.desenhar = desenhar;
		this.iniciar = iniciar;
		this.obterLinhaSelecionada = obterLinhaSelecionada;
		this.remover = remover;
	};

	app.Game = {
		ListController: GameListController,
		Service: GameService
	};


})(app);