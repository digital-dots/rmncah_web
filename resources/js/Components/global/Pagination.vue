<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    links: {
        type: Array,
        required: true
    }
})

// Function to get visible page links
const getVisiblePageLinks = () => {
    const pageLinks = props.links.slice(1, -1)
    const currentPage = pageLinks.findIndex(link => link.active) + 1
    const lastPage = pageLinks.length

    let startPage = Math.max(currentPage - 2, 1)
    let endPage = Math.min(startPage + 4, lastPage)

    if (endPage - startPage < 4) {
        startPage = Math.max(endPage - 4, 1)
    }

    return pageLinks.map((link, index) => {
        const pageNumber = index + 1
        if (
            pageNumber === 1 || // First page
            pageNumber === lastPage || // Last page
            (pageNumber >= startPage && pageNumber <= endPage) // Pages in range
        ) {
            return { ...link, show: true }
        }
        // Show ellipsis
        if (pageNumber === startPage - 1 || pageNumber === endPage + 1) {
            return { label: '...', url: null, show: true }
        }
        return { ...link, show: false }
    }).filter(link => link.show)
}
</script>

<template>
    <div v-if="links.length > 3" class="flex justify-end mt-4">
        <nav class="flex items-center gap-1">
            <!-- Previous Button -->
            <Link
                v-if="links[0].url"
                :href="links[0].url"
                class="p-2 text-sm rounded-lg hover:bg-gray-100"
                :class="{ 'text-gray-400 cursor-not-allowed': !links[0].url }"
            >
                Previous
            </Link>
            
            <!-- Page Numbers -->
            <template v-for="(link, key) in getVisiblePageLinks()" :key="key">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    class="w-10 h-10 flex items-center justify-center rounded-lg text-sm hover:bg-gray-100"
                    :class="{ 'bg-black text-white hover:bg-gray-800': link.active }"
                >
                    {{ link.label }}
                </Link>
                <span
                    v-else
                    class="w-10 h-10 flex items-center justify-center text-gray-400 text-sm"
                >
                    {{ link.label }}
                </span>
            </template>

            <!-- Next Button -->
            <Link
                v-if="links[links.length - 1].url"
                :href="links[links.length - 1].url"
                class="p-2 text-sm rounded-lg hover:bg-gray-100"
                :class="{ 'text-gray-400 cursor-not-allowed': !links[links.length - 1].url }"
            >
                Next
            </Link>
        </nav>
    </div>
</template>
