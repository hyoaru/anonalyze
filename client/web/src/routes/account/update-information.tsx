import { createFileRoute } from '@tanstack/react-router'

export const Route = createFileRoute('/account/update-information')({
  component: () => <div>Hello /account/update-information!</div>,
})
