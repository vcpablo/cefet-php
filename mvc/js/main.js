(function(app){
	$(document).ready(function() {

		var service = new app.Game.Service();
		var listController = new app.Game.ListController(service);
		listController.iniciar();

		$("#remover").click(listController.remover);

	});
})(app);