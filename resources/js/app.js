for (const id of ['toast-success', 'toast-error']) {
	const el = document.getElementById(id);
	if (!el) continue;

	setTimeout(() => {
		el.style.transition = 'opacity 0.3s ease';
		el.style.opacity = '0';
		setTimeout(() => el.remove(), 350);
	}, 2500);
}
