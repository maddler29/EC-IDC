<template>
    <label for="avatar">

            <input class="d-none" id="avatar" accept="image/png,image/jpeg,image/gif" type="file" name="avatar" @change="onFileChange($event)">
            <img :src="imageData" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
    </label>
</template>

<script>
export default {
    props: {
        initialImageDate: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            imageData: this.initialImageDate,
        };
    },
    methods: {
        onFileChange(e) {

            const files = e.target.files;

            if(files.length > 0) {

                const file = files[0];
                const reader = new FileReader();
                reader.onload = (e) => {

                    this.imageData = e.target.result;

                };

                reader.readAsDataURL(file);

            }

        },
    },
}
</script>
