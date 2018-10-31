window.addEventListener('load', async ()=>{
    let categorias = await fetch('http://localhost/projeto/api/categoria/read.php')
    categorias = await categorias.json()
    let div = document.querySelector('div#cat')
    for (let i = 0; i < categorias.length; i++) {
        let el = document.createElement('div')
        el.dataset.value = categorias[i].id
        el.innerText = categorias[i].nome
        
        el.addEventListener('click', async ()=>{
            
            let container = document.querySelector('div.posts')

            let posts = await fetch('http://localhost/projeto/api/post/readCategoria.php',
            {
                method: 'POST',
                body: JSON.stringify({id: el.dataset.value})        
            })
            posts = await posts.json()
           
            container.innerHTML = ''
            for (var i = 0 ; i < posts.length; i++) {
                console.log(posts[i])
                let x = document.createElement("div")
                x.innerHTML = posts[i].titulo + "<p>" + posts[i].texto + "</p>"
                x.dataset.value = posts[i].id_categoria
                container.appendChild(x)
            }

        })
        div.appendChild(el)
    }
})
