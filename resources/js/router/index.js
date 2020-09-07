import Home from '../views/Home' 
import About from '../views/About' 
import Contact from '../views/Contact'
import NewNote from '../views/notes/Create'
import TableNote from '../views/notes/Table'
import ShowNote from '../views/notes/Show'
import EditNote from '../views/notes/Edit'

export default{
    linkActiveClass: 'active',
    mode: 'history',
    routes:[
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'pages.about',
            component: About
        },
        {
            path: '/contact',
            name: 'pages.contact',
            component: Contact
        },
        {
            path: '/notes/create',
            name: 'notes.create',
            component: NewNote
        },
        {
            path: '/notes/table',
            name: 'notes.table',
            component: TableNote
        },
        {
            path: '/notes/:noteSlug',
            name: 'notes.show',
            component: ShowNote
        },
        {
            path: '/notes/:noteSlug/edit',
            name: 'notes.edit',
            component: EditNote
        },
    ]
}