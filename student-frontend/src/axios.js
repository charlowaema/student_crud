import axios from 'axios'

const instance = axios.create({
    baseURL: 'https://student-crud-main-pqqmnl.free.laravel.cloud/api'
})

export default instance