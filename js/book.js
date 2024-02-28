const elelist = ["checkoutname", "checkoutid", "checkoutdate"];
// temp store the elements
let store = ["", "", ""];

document.addEventListener('DOMContentLoaded', function() {
  // tried to do dry (dont repeat yourself)
  const cdate = document.querySelector("#disable");
  cdate.addEventListener("change", () => {
    for (let i = 0; i < elelist.length; i++) {
      let checked = cdate.checked === true;
      let query = document.querySelector(`#${elelist[i]}`);
      query.style.visibility = checked ? "hidden" : "visible";
      query.required = checked ? false : true;
      if (checked) {
        store[i] = query.value;
        query.value = "";
      } else {
        query.value = store[i];
        store[i] = "";
      }
      console.log('ok')
    }
  });
});