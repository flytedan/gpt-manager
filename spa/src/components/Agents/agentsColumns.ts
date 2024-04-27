import { filterActions } from "@/components/Agents/agentsActions";
import { activatePanel } from "@/components/Agents/agentsControls";

export const columns = [
    {
        name: "name",
        label: "Name",
        field: "name",
        align: "left",
        sortable: true,
        required: true,
        actionMenu: filterActions({ menu: true }),
        onClick: (agent) => activatePanel(agent, "edit")
    },
    {
        name: "model",
        label: "Model",
        field: "model",
        sortable: true,
        align: "left"
    },
    {
        name: "temperature",
        label: "Temperature",
        field: "temperature",
        sortable: true,
        required: true
    }
];
