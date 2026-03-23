import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ProdukController::index
* @see app/Http/Controllers/ProdukController.php:20
* @route '/produk'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/produk',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProdukController::index
* @see app/Http/Controllers/ProdukController.php:20
* @route '/produk'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProdukController::index
* @see app/Http/Controllers/ProdukController.php:20
* @route '/produk'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::index
* @see app/Http/Controllers/ProdukController.php:20
* @route '/produk'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ProdukController::index
* @see app/Http/Controllers/ProdukController.php:20
* @route '/produk'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::index
* @see app/Http/Controllers/ProdukController.php:20
* @route '/produk'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::index
* @see app/Http/Controllers/ProdukController.php:20
* @route '/produk'
*/
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index.form = indexForm

/**
* @see \App\Http\Controllers\ProdukController::show
* @see app/Http/Controllers/ProdukController.php:113
* @route '/produk/{produk}/show'
*/
export const show = (args: { produk: string | { slug: string } } | [produk: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/produk/{produk}/show',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProdukController::show
* @see app/Http/Controllers/ProdukController.php:113
* @route '/produk/{produk}/show'
*/
show.url = (args: { produk: string | { slug: string } } | [produk: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { produk: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
        args = { produk: args.slug }
    }

    if (Array.isArray(args)) {
        args = {
            produk: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        produk: typeof args.produk === 'object'
        ? args.produk.slug
        : args.produk,
    }

    return show.definition.url
            .replace('{produk}', parsedArgs.produk.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProdukController::show
* @see app/Http/Controllers/ProdukController.php:113
* @route '/produk/{produk}/show'
*/
show.get = (args: { produk: string | { slug: string } } | [produk: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::show
* @see app/Http/Controllers/ProdukController.php:113
* @route '/produk/{produk}/show'
*/
show.head = (args: { produk: string | { slug: string } } | [produk: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ProdukController::show
* @see app/Http/Controllers/ProdukController.php:113
* @route '/produk/{produk}/show'
*/
const showForm = (args: { produk: string | { slug: string } } | [produk: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::show
* @see app/Http/Controllers/ProdukController.php:113
* @route '/produk/{produk}/show'
*/
showForm.get = (args: { produk: string | { slug: string } } | [produk: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::show
* @see app/Http/Controllers/ProdukController.php:113
* @route '/produk/{produk}/show'
*/
showForm.head = (args: { produk: string | { slug: string } } | [produk: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

show.form = showForm

/**
* @see \App\Http\Controllers\ProdukController::preview
* @see app/Http/Controllers/ProdukController.php:153
* @route '/produk/{produk}/preview'
*/
export const preview = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: preview.url(args, options),
    method: 'get',
})

preview.definition = {
    methods: ["get","head"],
    url: '/produk/{produk}/preview',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProdukController::preview
* @see app/Http/Controllers/ProdukController.php:153
* @route '/produk/{produk}/preview'
*/
preview.url = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { produk: args }
    }

    if (Array.isArray(args)) {
        args = {
            produk: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        produk: args.produk,
    }

    return preview.definition.url
            .replace('{produk}', parsedArgs.produk.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProdukController::preview
* @see app/Http/Controllers/ProdukController.php:153
* @route '/produk/{produk}/preview'
*/
preview.get = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: preview.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::preview
* @see app/Http/Controllers/ProdukController.php:153
* @route '/produk/{produk}/preview'
*/
preview.head = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: preview.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ProdukController::preview
* @see app/Http/Controllers/ProdukController.php:153
* @route '/produk/{produk}/preview'
*/
const previewForm = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: preview.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::preview
* @see app/Http/Controllers/ProdukController.php:153
* @route '/produk/{produk}/preview'
*/
previewForm.get = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: preview.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::preview
* @see app/Http/Controllers/ProdukController.php:153
* @route '/produk/{produk}/preview'
*/
previewForm.head = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: preview.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

preview.form = previewForm

/**
* @see \App\Http\Controllers\ProdukController::create
* @see app/Http/Controllers/ProdukController.php:173
* @route '/produk/buat/baru'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/produk/buat/baru',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProdukController::create
* @see app/Http/Controllers/ProdukController.php:173
* @route '/produk/buat/baru'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProdukController::create
* @see app/Http/Controllers/ProdukController.php:173
* @route '/produk/buat/baru'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::create
* @see app/Http/Controllers/ProdukController.php:173
* @route '/produk/buat/baru'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ProdukController::create
* @see app/Http/Controllers/ProdukController.php:173
* @route '/produk/buat/baru'
*/
const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::create
* @see app/Http/Controllers/ProdukController.php:173
* @route '/produk/buat/baru'
*/
createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::create
* @see app/Http/Controllers/ProdukController.php:173
* @route '/produk/buat/baru'
*/
createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

create.form = createForm

/**
* @see \App\Http\Controllers\ProdukController::store
* @see app/Http/Controllers/ProdukController.php:425
* @route '/produk/store'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/produk/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\ProdukController::store
* @see app/Http/Controllers/ProdukController.php:425
* @route '/produk/store'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProdukController::store
* @see app/Http/Controllers/ProdukController.php:425
* @route '/produk/store'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\ProdukController::store
* @see app/Http/Controllers/ProdukController.php:425
* @route '/produk/store'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\ProdukController::store
* @see app/Http/Controllers/ProdukController.php:425
* @route '/produk/store'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \App\Http\Controllers\ProdukController::edit
* @see app/Http/Controllers/ProdukController.php:181
* @route '/produk/{produk}/edit'
*/
export const edit = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/produk/{produk}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProdukController::edit
* @see app/Http/Controllers/ProdukController.php:181
* @route '/produk/{produk}/edit'
*/
edit.url = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { produk: args }
    }

    if (Array.isArray(args)) {
        args = {
            produk: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        produk: args.produk,
    }

    return edit.definition.url
            .replace('{produk}', parsedArgs.produk.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProdukController::edit
* @see app/Http/Controllers/ProdukController.php:181
* @route '/produk/{produk}/edit'
*/
edit.get = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::edit
* @see app/Http/Controllers/ProdukController.php:181
* @route '/produk/{produk}/edit'
*/
edit.head = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ProdukController::edit
* @see app/Http/Controllers/ProdukController.php:181
* @route '/produk/{produk}/edit'
*/
const editForm = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::edit
* @see app/Http/Controllers/ProdukController.php:181
* @route '/produk/{produk}/edit'
*/
editForm.get = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ProdukController::edit
* @see app/Http/Controllers/ProdukController.php:181
* @route '/produk/{produk}/edit'
*/
editForm.head = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: edit.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

edit.form = editForm

/**
* @see \App\Http\Controllers\ProdukController::update
* @see app/Http/Controllers/ProdukController.php:193
* @route '/produk/{produk}/update'
*/
export const update = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/produk/{produk}/update',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\ProdukController::update
* @see app/Http/Controllers/ProdukController.php:193
* @route '/produk/{produk}/update'
*/
update.url = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { produk: args }
    }

    if (Array.isArray(args)) {
        args = {
            produk: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        produk: args.produk,
    }

    return update.definition.url
            .replace('{produk}', parsedArgs.produk.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProdukController::update
* @see app/Http/Controllers/ProdukController.php:193
* @route '/produk/{produk}/update'
*/
update.put = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\ProdukController::update
* @see app/Http/Controllers/ProdukController.php:193
* @route '/produk/{produk}/update'
*/
const updateForm = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\ProdukController::update
* @see app/Http/Controllers/ProdukController.php:193
* @route '/produk/{produk}/update'
*/
updateForm.put = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

update.form = updateForm

/**
* @see \App\Http\Controllers\ProdukController::toggleActive
* @see app/Http/Controllers/ProdukController.php:512
* @route '/produk/{produk}/toggle-active'
*/
export const toggleActive = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: toggleActive.url(args, options),
    method: 'put',
})

toggleActive.definition = {
    methods: ["put"],
    url: '/produk/{produk}/toggle-active',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\ProdukController::toggleActive
* @see app/Http/Controllers/ProdukController.php:512
* @route '/produk/{produk}/toggle-active'
*/
toggleActive.url = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { produk: args }
    }

    if (Array.isArray(args)) {
        args = {
            produk: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        produk: args.produk,
    }

    return toggleActive.definition.url
            .replace('{produk}', parsedArgs.produk.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProdukController::toggleActive
* @see app/Http/Controllers/ProdukController.php:512
* @route '/produk/{produk}/toggle-active'
*/
toggleActive.put = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: toggleActive.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\ProdukController::toggleActive
* @see app/Http/Controllers/ProdukController.php:512
* @route '/produk/{produk}/toggle-active'
*/
const toggleActiveForm = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: toggleActive.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\ProdukController::toggleActive
* @see app/Http/Controllers/ProdukController.php:512
* @route '/produk/{produk}/toggle-active'
*/
toggleActiveForm.put = (args: { produk: string | number } | [produk: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: toggleActive.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

toggleActive.form = toggleActiveForm

const ProdukController = { index, show, preview, create, store, edit, update, toggleActive }

export default ProdukController