async function checkoutBook(bookId) {
  const githubUrl = `
    api/update_books.php
  `;
  var formData = new FormData();
  formData.append('checkout', ':3')
  formData.append('bookid', bookId);
  const res = await fetch(githubUrl, { method: 'POST', body: formData   })

  Swal.fire({
    title: "Good job!",
    text: "You sucessfully checked out!",
    icon: "success"
  });
  
}

async function cat(bookId, ip) {
  const { value: id } = await Swal.fire({
    title: "Enter their ID!",
    input: "number",
    icon: "question",
    inputLabel: "Please enter the student's ID",
    inputPlaceholder: "Student ID",
    showCancelButton: true,
    icon: "question",
    inputValidator: (value) => {
      if (!value) {
        return "You need to write something!";
      }
    },
    preConfirm: async (login) => {
      try {
        const githubUrl = `
          api/update_books.php
        `;
        var formData = new FormData();
        formData.append('id', login);
        formData.append('name', ip);
        formData.append('bookid', bookId);
        const res = await fetch(githubUrl, { method: 'POST', body: formData })
        
        return true;
      } catch (err) {
        Swal.showValidationMessage(`
          Request failed: ${err}
        `);
      }
    }

  }).then((result) => {
    if (result) {
      Swal.fire({
        title: "Good job!",
        text: "Book successfully has been checked in!",
        icon: "success"
      });
    }
  });
}
async function checkInBook(bookId) {
  const { value: ipAddress } = await Swal.fire({
    title: "Enter the name!",
    input: "text",
    inputLabel: "Please enter the name of the student",
    inputPlaceholder: "Student's name",
    showCancelButton: true,
    icon: "question",
    inputValidator: (value) => {
      if (!value) {
        return "You need to write something!";
      }
    }
  })
  cat(bookId, ipAddress)
}

// async function editBook(bookId) {
//   const steps = ['1', '2'];
//   const Queue = Swal.mixin({
//     progressSteps: steps,
//     confirmButtonText: 'Next'
//   })

//   ;(async () => {
//     await Queue.fire({
//       title: "What is the new book name?",
//       input: "text",
//       inputPlaceholder: "The new book name",
//       showCancelButton: true,
//       icon: "question",
//       currentProgressStep: 0,
//       inputValidator: (value) => {
//         if (!value) {
//           return "You need to write something!";
//         }
//       }
//     })
//   })()  
// }

// async function deleteBook(bookId) {
//   await Swal.fire({
//     title: "Are you really sure?",
//     input: "text",
//     text: "You can not undo the deletion of this book.",
//     buttons: true,
//     dangerMode: true,
//     icon: "warning",
//   }).then((willDelete) => {
//     if (willDelete) {
//       console.log('wip')
//     } else {
//       console.log('wip')
//     }
//   })
// }

document.addEventListener('DOMContentLoaded', function() {

  // setup code
  const elementsArray = document.querySelectorAll("#update-book");
  const back = document.querySelector("#test");
  console.log(elementsArray);
  back.addEventListener("click", () => {
    window.location.href = "./index.php";
  })
  elementsArray.forEach(function(elem) {
    
    elem.addEventListener("click", async function() {
      
      const {value: book} = await Swal.fire({
        title: 'Update Book',
        text: 'What do you want to change about this book?',
        input: "select",
        icon: "question",
        inputOptions: {
          // Book: {
          //   edit: "Edit Book",
          //   delete: "Remove Book",
          // //   img: "Change Book Image",
          // },

          Check: {
            in: "Check-in Book",
            out: "Checkout Book"
          }
        },
        inputValidator: (value) => {
          if (!value) {
            return "You need to choose something!";
          }

          if (value) {
            switch (value) {
              case "in":
                checkInBook(elem.getAttribute("book-id"))
                break;
              case "out":
                checkoutBook(elem.getAttribute("book-id"))
                break;
              default:
                break;
            }
          }
          
        },
        inputPlaceholder: "Select an option",
        showCancelButton: true,
      })
      
    });

    
  });

  
});
                        