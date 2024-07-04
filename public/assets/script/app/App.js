function showUl()
{
    var ul = document.querySelector('#data-ul');
    var dataul = "";
    var data = [
        {
            "nama_menu" : "Dashboard",
            "icon"      : "fa-home",
            "link"      : "/dashboard" 
        },
        {
            "nama_menu" : "Penghuni",
            "icon"      : "fa-user",
            "link"      : "" 
        }
    ];
    data.forEach(function (e) {
        var li = `<li class="nav-item">
                    <a href="${e.link}" class="nav-link">
                    <i class="far fa-circle nav-icon fas ${e.icon}"></i>
                    <p>${e.nama_menu}</p>
                    </a>
                </li>`;
        dataul = dataul + li;
    });
    ul.innerHTML = dataul;
}
export default function App() {
    //showUl();
}