//import config from 'config';
import { authHeader, handleResponse } from '../_helpers';
import { environment } from '../environments/environment';

export const productService = {
    getAll,
    getByID,
    deleteItem,
    createItem,
    updateItem
};

function getAll() {
    const requestOptions = { method: 'GET', headers: authHeader() };
    return fetch(`${environment.apiUrl}/products`, requestOptions).then(handleResponse);
}

function getByID(id) {
    const requestOptions = { method: 'GET', headers: authHeader() };
    return fetch(`${environment.apiUrl}/products/${id}`, requestOptions).then(handleResponse);
}

function deleteItem(id) {
    const requestOptions = { method: 'DELETE', headers: authHeader() };
    return fetch(`${environment.apiUrl}/products/delete/${id}`, requestOptions).then(handleResponse);
}

function createItem(request) {
    const requestOptions = {
        method: 'POST',
        headers: authHeader(),
        body: JSON.stringify(request)
    };
    return fetch(`${environment.apiUrl}/products/store`, requestOptions).then(handleResponse);
}

function updateItem(id, request) {
    const requestOptions = {
        method: 'PATCH',
        headers: authHeader(),
        body: JSON.stringify(request)
    };
    return fetch(`${environment.apiUrl}/products/update/${id}`, requestOptions).then(handleResponse);
}
