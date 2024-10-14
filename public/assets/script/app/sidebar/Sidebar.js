import { sidebar_data_gedung } from "../config/EndPoint.js";
const view_sidebar = document.querySelector(".all-gedung");
export async function Sidebar() {
  try {
    const response = await fetch(sidebar_data_gedung);
    if (response.ok) {
      const data = await response.json();
      showSidebar(data);
    } else {
      throw new Error(response.statusText);
    }
  } catch (error) {
    console.log(error);
  }
}
function showSidebar(data) {
  let data_gedung = ``;
  data.forEach((element) => {
    data_gedung =
      data_gedung +
      `
            <li class="nav-item">
                <a href="/gedung/${element.kode_gedung}/penghuni" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>${element.nama_gedung}</p>
                </a>
            </li>
        `;
  });
  view_sidebar.innerHTML = data_gedung;
}
