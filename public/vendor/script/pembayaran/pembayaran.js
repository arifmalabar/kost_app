let transfer = document.querySelector('#transfer');
let tunai = document.querySelector("#tunai");
let input_bukti = document.querySelector(".input-bukti")

export default function App() {
    transfer.addEventListener("click", function (param) {
        input_bukti.innerHTML = `<div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Bukti Transfer</label>
                                <div class="col-sm-8">
                                  <input type="file" name="bukti_transfer" id="">
                                </div>
                            </div>`;
    });
    tunai.addEventListener("click", function (params) {
        input_bukti.innerHTML = ``;
    })
}
