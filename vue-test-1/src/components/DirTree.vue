<script>
import { mapActions, mapState, setActivePinia } from "pinia";
import { useStorageStore } from "@/stores/storage";
import _ from "lodash";

export default {
    name: "DirTree",
    props: {
        dirs: {
            type: Array
        }
    },
    methods: {
        setActivePinia,
        isLastLevel(dir) {
            return !Array.isArray(dir.children) || !dir.children.some(item => Array.isArray(item.children));
        },
        ...mapActions(useStorageStore, ["setActiveFolder"])
    },
    computed: {
        ...mapState(useStorageStore, ["activeFolder"])
    }
};
</script>

<template>
    <div class="mt-1">
        <ul v-if="Array.isArray(dirs)" class="space-y-1">
            <li v-for="item in dirs" :key="item.id" class="cursor-pointer"
                :style="{ 'margin-left': `${(item.id.toString().length - 1) * 24}px` }">
                <div class="flex items-center gap-2 rounded px-1 py-1 text-gray-400"
                     @click="setActiveFolder(item)"
                     :class="{ 'bg-blue-50 !text-blue-600 font-semibold': activeFolder.id === item.id }">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         class="transition-all"
                         :class="{ '-rotate-90': activeFolder.id === item.id || activeFolder.parents.includes(item.id) }">
                        <path fill="currentColor"
                              d="M12.6 12L8.7 8.1q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l4.6 4.6q.15.15.213.325t.062.375q0 .2-.063.375t-.212.325l-4.6 4.6q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7l3.9-3.9Z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M4 20q-.825 0-1.413-.588T2 18V6q0-.825.588-1.413T4 4h6l2 2h8q.825 0 1.413.588T22 8H4v10l2.4-8h17.1l-2.575 8.575q-.2.65-.738 1.038T19 20H4Z"/>
                    </svg>
                    {{ item.name }}
                    <span class="rounded bg-gray-300 px-1 text-xs"
                          :class="{ 'bg-blue-500 text-white': activeFolder.id === item.id }">
                        {{ item.children.length }}
                    </span>
                </div>
                <DirTree :dirs="item.children"
                         v-show="activeFolder.id === item.id || activeFolder.parents.includes(item.id)"
                         v-if="!isLastLevel(item)"/>
            </li>
        </ul>
    </div>
</template>

<style scoped>

</style>