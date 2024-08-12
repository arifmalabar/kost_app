import { pembayaran_penghuni } from "../config/EndPoint.js";


export default async function getPenghuni() { 
    await fetch(pembayaran_penghuni)
        .then(response => {
            return response.json();
        })
        .then(data => {
            showTables(data);
        })
        .catch(err => {
            console.log(err);
        });
}
function showTables(dt)
{
    
    console.log(dt[0]);
}