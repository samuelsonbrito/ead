<template>
    <div>
        <ul class="nav">
            <li class="nav-item">
                <router-link :to="{name: 'home'}" class="nav-link">Home</router-link>
            </li>

            <li class="nav-item">
                <router-link :to="{name: 'contact'}" class="nav-link">Contato</router-link>
            </li>
        </ul>
    </div>
</template>
