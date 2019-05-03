function exit() {
		$.ajax({
			url: "users/browser_logout",
			method: "POST",
			data:{data:1},
		});
}

 window.onbeforeunload = exit();