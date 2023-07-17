const NotFound = {template: '<div>Not Found</div>'}

export default [
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound }
]
