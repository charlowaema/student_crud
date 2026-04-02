import axios from 'axios'

const instance = axios.create({
    //baseURL: 'http://127.0.0.1:8000/api'
     baseURL: 'https://student-crud-main-pqqmnl.free.laravel.cloud/api'  // 👈 update this
})

export default instance


// const instance = axios.create({
//     baseURL: 'http://127.0.0.1:8000/api'
// })

// export default instance

// import axios from 'axios'