// Simple React component for displaying resources
function ResourceDisplay({ resources }) {
    return (
        <div>
            <h3>Your Resources</h3>
            <p>Energy: {resources.energy}</p>
            <p>Minerals: {resources.minerals}</p>
        </div>
    );
}
