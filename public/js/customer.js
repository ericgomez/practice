const d = document

async function getData (id) {
  var fd = new FormData()
  fd.append('id', id)

  data = await fetch(
    'http://localhost:8080/practice/customer/getCustomerById()',
    {
      method: 'POST',
      body: fd // send form
    }
  )
    .then(res => res.json())
    .then(json => json)

  renderData(data)
}

function customerForm () {
  const $form = d.querySelector('.edit-form'),
    $inputs = d.querySelectorAll('.edit-form input')

  // console.log($inputs)

  $inputs.forEach(input => {
    const $span = d.createElement('span')

    $span.id = input.name
    $span.textContent = input.title
    $span.classList.add('contact-form-error', 'none')

    input.insertAdjacentElement('afterend', $span)
  })
}

function renderData (data) {
  console.log(data)
  // var databody = document.querySelector('#databody')
  // let total = 0
  // databody.innerHTML = ''
  // data.forEach(item => {
  //   //total += item.amount;
  //   databody.innerHTML += `<tr>
  //             <td>${item.title}</td>
  //             <td><span class="category" style="background-color: ${item.color}">${item.name}</span></td>
  //             <td>${item.date}</td>
  //             <td>$${item.amount}</td>
  //             <td><a href="http://localhost/system/expenses/delete/${item.id}">Eliminar</a></td>
  //         </tr>`
  // })
}

d.addEventListener('DOMContentLoaded', customerForm)

d.addEventListener('click', e => {
  e.preventDefault()
  if (e.target.matches('.btn')) {
    console.log(e.target.dataset.id)
    getData(e.target.dataset.id)
  }
})
