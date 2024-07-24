/*Création liste constante */
const list_Offres = [
	"Offre 1",
	"Offre 2",
	"Offre 3",
	"Offre 4",
	"Offre 5",
	"Offre 6",
	"Offre 7",
	"Offre 8",
	"Offre 9",
	"Offre 10",
	"Offre 11",
	"Offre 12",
	"Offre 13",
	"Offre 14",
	"Offre 15",
	"Offre 16",
	"Offre 17",
	"Offre 18",
	"Offre 19",
	"Offre 20",
	"Offre 21",
	"Offre 22"
];

/*Récupération des éléments */
const list_element = document.getElementById('list');
const pagination_element = document.getElementById('pagination');

/*Mise en place de la pagination */
let current_page = 1;
let rows = 5;

function DisplayList (Offres, wrapper, rows_per_page, page) {
	wrapper.innerHTML = "";
	page--;

	let start = rows_per_page * page;
	let end = start + rows_per_page;
	let paginatedOffres = Offres.slice(start, end);

	for (let i = 0; i < paginatedOffres.length; i++) {
		let Offre = paginatedOffres[i];

		let Offre_element = document.createElement('div');
		Offre_element.classList.add('Offre');
		Offre_element.innerText = Offre;
		
		wrapper.appendChild(Offre_element);
	}
}

function SetupPagination (Offres, wrapper, rows_per_page) {
	wrapper.innerHTML = "";

	let page_count = Math.ceil(Offres.length / rows_per_page);
	for (let i = 1; i < page_count + 1; i++) {
		let btn = PaginationButton(i, Offres);
		wrapper.appendChild(btn);
	}
}

function PaginationButton (page, Offres) {
	let button = document.createElement('button');
	button.innerText = page;

	if (current_page == page) button.classList.add('active');

	button.addEventListener('click', function () {
		current_page = page;
		DisplayList(Offres, list_element, rows, current_page);

		let current_btn = document.querySelector('.pagenumbers button.active');
		current_btn.classList.remove('active');

		button.classList.add('active');
	});

	return button;
}

DisplayList(list_Offres, list_element, rows, current_page);
SetupPagination(list_Offres, pagination_element, rows);