import axios from 'axios'

export const http = axios.create({
	baseURL: '/api/v1',
	timeout: 10000,
	headers: {
		//'Access-Control-Allow-Origin':	'*',
		//'content-type': 'multipart/form-data',
	},
});