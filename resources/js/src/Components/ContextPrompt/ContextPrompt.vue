<template>
    <div class="dt-context-prompt">
        <v-menu bottom left>
            <template v-slot:activator="{ props }">
                <slot name="activator">
                    <v-btn icon v-bind="props">
                        <v-icon>mdi-close-circle-outline</v-icon>
                    </v-btn>
                </slot>
            </template>
            <slot></slot>
        </v-menu>
    </div>
</template>

<script>
export default {
    name: "ContextPrompt",
};
</script>
