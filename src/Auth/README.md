User authentication and sessions
================================

h2. Entities
------------

`User` application level user
`IdentityProvider` type of authentication, i.e. password, link by email, oauth
`Identity` user credentials for `IdentityProvider`
`Session` has cookie tokens issued for `Identity`
`UserIdentity` stores relations between `User` and `Identity`

h2. Auth flow
-------------

User invokes `IdentityProvider` procedure. On success, `IdentityProvider` calls `Auth::signIn` to create `Session`.
User agent receives cookie with `Session` token.

One `Identity` can belong to multiple `User`.

On log out, `Session` is being deleted.

`Auth` provides list of logged in `User` on demand (using cookie token).