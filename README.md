Git Web Hook em PHP 
===================



##Sobre
Verifica alterações do repo git, e faz git clone caso o projeto não exista, ou pull das ultimas alterações do código.

####Example: Payload.json, retorno API github:

```js
payload {
"ref": "refs/heads/master",
        "before": "365ce090aaa0851eab21e8f3a1770976d807df92",
        "after": "672684e468d5af5678f8166ceee8f52386528113",
        "created": false,
        "deleted": false,
        "forced": false,
        "base_ref": null,
        "compare": "https://github.com/rcalderini/test/compare/365ce090aaa0...672684e468d5",
        "commits": [
        {
        "id": "672684e468d5af5678f8166ceee8f52386528113",
                "distinct": true,
                "message": "Update test",
                "timestamp": "2014-12-29T10:19:37-02:00",
                "url": "https://github.com/rcalderini/test/commit/672684e468d5af5678f8166ceee8f52386528113",
                "author": {
                "name": "rcalderini",
                        "email": "roger_calderini@hotmail.com",
                        "username": "rcalderini"
                },
                "committer": {
                "name": "rcalderini",
                        "email": "roger_calderini@hotmail.com",
                        "username": "rcalderini"
                },
                "added": [

                ],
                "removed": [

                ],
                "modified": [
                        "test"
                ]
        }
        ],
        "head_commit": {
        "id": "672684e468d5af5678f8166ceee8f52386528113",
                "distinct": true,
                "message": "Update test",
                "timestamp": "2014-12-29T10:19:37-02:00",
                "url": "https://github.com/rcalderini/test/commit/672684e468d5af5678f8166ceee8f52386528113",
                "author": {
                "name": "rcalderini",
                        "email": "roger_calderini@hotmail.com",
                        "username": "rcalderini"
                },
                "committer": {
                "name": "rcalderini",
                        "email": "roger_calderini@hotmail.com",
                        "username": "rcalderini"
                },
                "added": [

                ],
                "removed": [

                ],
                "modified": [
                        "test"
                ]
        },
        "repository": {
        "id": 27726080,
                "name": "test",
                "full_name": "rcalderini/test",
                "owner": {
                "name": "rcalderini",
                        "email": "roger_calderini@hotmail.com"
                },
                "private": false,
                "html_url": "https://github.com/rcalderini/test",
                "description": "",
                "fork": false,
                "url": "https://github.com/rcalderini/test",
                "forks_url": "https://api.github.com/repos/rcalderini/test/forks",
                "keys_url": "https://api.github.com/repos/rcalderini/test/keys{/key_id}",
                "collaborators_url": "https://api.github.com/repos/rcalderini/test/collaborators{/collaborator}",
                "teams_url": "https://api.github.com/repos/rcalderini/test/teams",
                "hooks_url": "https://api.github.com/repos/rcalderini/test/hooks",
                "issue_events_url": "https://api.github.com/repos/rcalderini/test/issues/events{/number}",
                "events_url": "https://api.github.com/repos/rcalderini/test/events",
                "assignees_url": "https://api.github.com/repos/rcalderini/test/assignees{/user}",
                "branches_url": "https://api.github.com/repos/rcalderini/test/branches{/branch}",
                "tags_url": "https://api.github.com/repos/rcalderini/test/tags",
                "blobs_url": "https://api.github.com/repos/rcalderini/test/git/blobs{/sha}",
                "git_tags_url": "https://api.github.com/repos/rcalderini/test/git/tags{/sha}",
                "git_refs_url": "https://api.github.com/repos/rcalderini/test/git/refs{/sha}",
                "trees_url": "https://api.github.com/repos/rcalderini/test/git/trees{/sha}",
                "statuses_url": "https://api.github.com/repos/rcalderini/test/statuses/{sha}",
                "languages_url": "https://api.github.com/repos/rcalderini/test/languages",
                "stargazers_url": "https://api.github.com/repos/rcalderini/test/stargazers",
                "contributors_url": "https://api.github.com/repos/rcalderini/test/contributors",
                "subscribers_url": "https://api.github.com/repos/rcalderini/test/subscribers",
                "subscription_url": "https://api.github.com/repos/rcalderini/test/subscription",
                "commits_url": "https://api.github.com/repos/rcalderini/test/commits{/sha}",
                "git_commits_url": "https://api.github.com/repos/rcalderini/test/git/commits{/sha}",
                "comments_url": "https://api.github.com/repos/rcalderini/test/comments{/number}",
                "issue_comment_url": "https://api.github.com/repos/rcalderini/test/issues/comments/{number}",
                "contents_url": "https://api.github.com/repos/rcalderini/test/contents/{+path}",
                "compare_url": "https://api.github.com/repos/rcalderini/test/compare/{base}...{head}",
                "merges_url": "https://api.github.com/repos/rcalderini/test/merges",
                "archive_url": "https://api.github.com/repos/rcalderini/test/{archive_format}{/ref}",
                "downloads_url": "https://api.github.com/repos/rcalderini/test/downloads",
                "issues_url": "https://api.github.com/repos/rcalderini/test/issues{/number}",
                "pulls_url": "https://api.github.com/repos/rcalderini/test/pulls{/number}",
                "milestones_url": "https://api.github.com/repos/rcalderini/test/milestones{/number}",
                "notifications_url": "https://api.github.com/repos/rcalderini/test/notifications{?since,all,participating}",
                "labels_url": "https://api.github.com/repos/rcalderini/test/labels{/name}",
                "releases_url": "https://api.github.com/repos/rcalderini/test/releases{/id}",
                "created_at": 1418059297,
                "updated_at": "2014-12-08T17:21:37Z",
                "pushed_at": 1419855577,
                "git_url": "git://github.com/rcalderini/test.git",
                "ssh_url": "git@github.com:rcalderini/test.git",
                "clone_url": "https://github.com/rcalderini/test.git",
                "svn_url": "https://github.com/rcalderini/test",
                "homepage": null,
                "size": 324,
                "stargazers_count": 0,
                "watchers_count": 0,
                "language": null,
                "has_issues": true,
                "has_downloads": true,
                "has_wiki": true,
                "has_pages": false,
                "forks_count": 0,
                "mirror_url": null,
                "open_issues_count": 0,
                "forks": 0,
                "open_issues": 0,
                "watchers": 0,
                "default_branch": "master",
                "stargazers": 0,
                "master_branch": "master"
        },
        "pusher": {
        "name": "rcalderini",
                "email": "roger_calderini@hotmail.com"
        },
        "sender": {
        "login": "rcalderini",
                "id": 7644168,
                "avatar_url": "https://avatars.githubusercontent.com/u/7644168?v=3",
                "gravatar_id": "",
                "url": "https://api.github.com/users/rcalderini",
                "html_url": "https://github.com/rcalderini",
                "followers_url": "https://api.github.com/users/rcalderini/followers",
                "following_url": "https://api.github.com/users/rcalderini/following{/other_user}",
                "gists_url": "https://api.github.com/users/rcalderini/gists{/gist_id}",
                "starred_url": "https://api.github.com/users/rcalderini/starred{/owner}{/repo}",
                "subscriptions_url": "https://api.github.com/users/rcalderini/subscriptions",
                "organizations_url": "https://api.github.com/users/rcalderini/orgs",
                "repos_url": "https://api.github.com/users/rcalderini/repos",
                "events_url": "https://api.github.com/users/rcalderini/events{/privacy}",
                "received_events_url": "https://api.github.com/users/rcalderini/received_events",
                "type": "User",
                "site_admin": false
        }
}
]
