<script>
import DirTree from "@/components/DirTree.vue";
import { mapActions, mapState } from "pinia";
import { useStorageStore } from "@/stores/storage";
import { calculateTotalSize, formatBytes, getAllFiles, roundDecimal } from "@/helpers/helper";

export default {
    name: "App",
    components: { DirTree },
    data() {
        return {
            chosenMember: ["All"],
            search: ""
        };
    },
    computed: {
        ...mapState(useStorageStore, {
            chosenMember: "chosenMember",
            files: "getFiles",
            activeFolder: "activeFolder"
        }),
        members() {
            return new Set(["All", ...this.files.reduce((acc, item) => {
                return acc.concat(this.getMember(item));
            }, [])]);
        }
    },
    methods: {
        roundDecimal,
        formatBytes,
        calculateTotalSize,
        getAllFiles,
        getMember(file) {
            let member = [];

            if (file.photo_by) {
                member.push(file.photo_by);
            }

            if (file.children && file.children.length > 0) {
                file.children.forEach(child => {
                    member = member.concat(this.getMember(child));
                });
            }

            return member;
        },
        ...mapActions(useStorageStore, ["setActiveFolder", "updateMember"]),
        updateMember(member, isAdd) {
            if (isAdd) {
                this.chosenMember.push(member);
            } else {
                this.chosenMember = this.chosenMember.filter(item => item !== member);
            }
        }
    },
    created() {
        this.setActiveFolder(this.files[0]);
    }
};
</script>

<template>
    <div class="w-72 border-r p-8 shrink-0">
        <button class="flex h-16 w-full items-center justify-center rounded-lg bg-blue-600 font-bold text-white">
            Import documents
        </button>

        <hr class="my-8">

        <div>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-gray-400">Storage</h2>
                <a href="#" class="text-sm underline">Change plan</a>
            </div>
            <div class="mt-4 w-full rounded-full bg-gray-200 h-2.5">
                <div class="rounded-full bg-blue-600 h-2.5"
                     :style="{ 'width': roundDecimal(calculateTotalSize(files) / 2000000000 * 100, 2) + '%' }"></div>
            </div>
            <div class="mt-2">
                <span class="font-bold text-blue-600">
                    {{ roundDecimal(calculateTotalSize(files) / 2000000000 * 100, 2) }}%
                </span> use of 2GB
            </div>
        </div>

        <hr class="my-8">

        <div>
            <h2 class="font-semibold text-gray-400">Search</h2>
            <div class="relative mt-4">
                <input type="text" class="w-full rounded-lg border pl-4 pr-8 py-2" placeholder="e.g. image.png"
                       v-model="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                     class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400">
                    <path fill="currentColor"
                          d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z"/>
                </svg>
            </div>
        </div>

        <hr class="my-8">

        <div>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-gray-400">Folder</h2>
                <a href="#" class="text-sm underline">New folder</a>
            </div>
            <DirTree :dirs="files"/>
        </div>

        <hr class="my-8">

        <div>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-gray-400">Members</h2>
                <a href="#" class="text-sm underline">Select all</a>
            </div>
            <div class="flex items-center mt-2" v-for="member in members" :key="member">
                <input :id="`member-${member}`" type="checkbox" value="" :checked="chosenMember.includes(member)"
                       @change="updateMember(member, $event.target.checked)"
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-0 accent-blue-600">
                <label :for="`member-${member}`" class="ms-2 text-sm font-medium text-gray-900">{{ member }}</label>
            </div>
        </div>
    </div>
    <div class="grow">
        <div class="grid grid-cols-12 text-gray-500">
            <div class="col-span-1 p-8 flex items-center">
                <div class="flex items-center">
                    <input id="checked-checkbox" type="checkbox" value=""
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-0 accent-blue-600">
                </div>
            </div>
            <div class="col-span-5 p-8">
                <a href="#">Select all</a>
            </div>
            <div class="col-span-2 p-8">
                <a href="#" class="flex items-center">
                    Name
                    <div class="relative">
                        <svg class="absolute left-0 -top-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 16 16">
                            <path fill="currentColor"
                                  d="m4.427 9.573l3.396-3.396a.25.25 0 0 1 .354 0l3.396 3.396a.25.25 0 0 1-.177.427H4.604a.25.25 0 0 1-.177-.427Z"/>
                        </svg>
                        <svg class="absolute left-0 -top-1.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 16 16">
                            <path fill="currentColor"
                                  d="m4.427 7.427l3.396 3.396a.25.25 0 0 0 .354 0l3.396-3.396A.25.25 0 0 0 11.396 7H4.604a.25.25 0 0 0-.177.427Z"/>
                        </svg>
                    </div>
                </a>
            </div>
            <div class="col-span-2 p-8">
                <a href="#" class="flex items-center">
                    Dimension
                    <div class="relative">
                        <svg class="absolute left-0 -top-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 16 16">
                            <path fill="currentColor"
                                  d="m4.427 9.573l3.396-3.396a.25.25 0 0 1 .354 0l3.396 3.396a.25.25 0 0 1-.177.427H4.604a.25.25 0 0 1-.177-.427Z"/>
                        </svg>
                        <svg class="absolute left-0 -top-1.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 16 16">
                            <path fill="currentColor"
                                  d="m4.427 7.427l3.396 3.396a.25.25 0 0 0 .354 0l3.396-3.396A.25.25 0 0 0 11.396 7H4.604a.25.25 0 0 0-.177.427Z"/>
                        </svg>
                    </div>
                </a>
            </div>
            <div class="col-span-2 p-8">
                <a href="#" class="flex items-center">
                    Size
                    <div class="relative">
                        <svg class="absolute left-0 -top-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 16 16">
                            <path fill="currentColor"
                                  d="m4.427 9.573l3.396-3.396a.25.25 0 0 1 .354 0l3.396 3.396a.25.25 0 0 1-.177.427H4.604a.25.25 0 0 1-.177-.427Z"/>
                        </svg>
                        <svg class="absolute left-0 -top-1.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 16 16">
                            <path fill="currentColor"
                                  d="m4.427 7.427l3.396 3.396a.25.25 0 0 0 .354 0l3.396-3.396A.25.25 0 0 0 11.396 7H4.604a.25.25 0 0 0-.177.427Z"/>
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-12 text-gray-500"
             v-for="item in getAllFiles(this.activeFolder, this.chosenMember, this.search)">
            <div class="col-span-1 p-8 flex items-center">
                <div class="flex items-center">
                    <input id="checked-checkbox" type="checkbox" value=""
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-0 accent-blue-600">
                </div>
            </div>
            <div class="col-span-5 p-8">
                <img class="w-full h-48 object-cover rounded" :src="item.url" alt="">
            </div>
            <div class="col-span-2 p-8 flex items-center">
                {{ item.name }}
            </div>
            <div class="col-span-2 p-8 flex items-center">
                {{ item.dimension }}
            </div>
            <div class="col-span-2 p-8 flex items-center">
                {{ formatBytes(item.size) }}
            </div>
        </div>
    </div>
</template>
